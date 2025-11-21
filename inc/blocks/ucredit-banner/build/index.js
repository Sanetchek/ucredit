/* global wp */
(function () {
  const { registerBlockType } = wp.blocks;
  const { __ } = wp.i18n;
  const el = wp.element.createElement;
  const Fragment = wp.element.Fragment;
  const { useState, useEffect } = wp.element;

  const {
    useBlockProps,
    InspectorControls,
    BlockControls,
    MediaPlaceholder,
    MediaUpload,
    MediaUploadCheck,
    MediaReplaceFlow,
    RichText
  } = wp.blockEditor || wp.editor;

  const {
    PanelBody,
    TextControl,
    ToggleControl,
    SelectControl,
    Spinner,
    Notice,
    Button,
    ToolbarGroup,
    ToolbarButton
  } = wp.components;

  const apiFetch = wp.apiFetch;

  registerBlockType('ucredit/banner', {
    edit: function (props) {
      const a = props.attributes;
      const set = props.setAttributes;
      const blockProps = useBlockProps({
          className: 'footer__banner',
          style: {
              position: 'relative',
              backgroundColor: '#1a4dbe',
              borderRadius: '.625rem',
              padding: '2.1875rem 0 0 3.75rem',
              display: 'flex',
              alignItems: 'center',
              gap: '20px',
              minHeight: 'auto',
              flexDirection: 'row-reverse',
              color: '#fff',
          }
      });

      // --- CF7 forms loading (for the modal select)
      const [forms, setForms] = useState([]);
      const [formsLoaded, setFormsLoaded] = useState(false);
      const [formsError, setFormsError] = useState('');

      useEffect(function () {
        let mounted = true;
        apiFetch({ path: '/contact-form-7/v1/contact-forms' })
          .then(function (res) {
            if (!mounted) return;
            const list = Array.isArray(res)
              ? res.map(function (f) { return { label: f.title, value: f.id }; })
              : [];
            setForms(list);
            setFormsLoaded(true);
          })
          .catch(function () {
            if (!mounted) return;
            setFormsError(__('Contact Form 7 not available or REST API blocked.', 'ucredit'));
            setFormsLoaded(true);
          });
        return function () { mounted = false; };
      }, []);

      // --- Image handlers
      const onSelectImage = function (media) {
        if (!media) return;
        set({
          imageId: media.id || 0,
          imageUrl: media.url || '',
          imageAlt: media.alt || 'banner'
        });
      };

      const onReplaceImage = onSelectImage;

      const onRemoveImage = function () {
        set({ imageId: 0, imageUrl: '', imageAlt: '' });
      };

      // --- CF7 select handlers
      const formOptions = [{ label: __('— Select form —', 'ucredit'), value: 0 }].concat(forms);

      const onSelectForm = function (val) {
        const idNum = parseInt(val, 10) || 0;
        const found = forms.find(function (o) { return parseInt(o.value, 10) === idNum; });
        set({
          cf7FormId: idNum,
          cf7FormTitle: found ? found.label : ''
        });
      };

      return el(
        Fragment,
        null,

        // ===== TOP TOOLBAR (replace/remove image) =====
        el(
          BlockControls,
          null,
          el(
            ToolbarGroup,
            null,
            el(MediaReplaceFlow, {
              mediaId: a.imageId || 0,
              mediaURL: a.imageUrl || '',
              allowedTypes: ['image'],
              accept: 'image/*',
              onSelect: onReplaceImage,
              name: __('Replace image', 'ucredit')
            }),
            !!a.imageUrl && el(ToolbarButton, {
              icon: 'trash',
              label: __('Remove image', 'ucredit'),
              onClick: onRemoveImage
            })
          )
        ),

        // ===== SIDEBAR CONTROLS =====
        el(
          InspectorControls,
          null,

          // Image panel
          el(
            PanelBody,
            { title: __('Banner Image', 'ucredit') },
            a.imageUrl
              ? el(Fragment, null,
                  el(TextControl, {
                    label: __('Image ALT', 'ucredit'),
                    value: a.imageAlt || '',
                    onChange: (v) => set({ imageAlt: v })
                  }),
                  el('div', { style: { display: 'flex', gap: '8px' } },
                    el(MediaUploadCheck, null,
                      el(MediaUpload, {
                        onSelect: onReplaceImage,
                        allowedTypes: ['image'],
                        value: a.imageId || 0,
                        render: function ({ open }) {
                          return el(Button, { onClick: open, variant: 'secondary' }, __('Replace image', 'ucredit'));
                        }
                      })
                    ),
                    el(Button, {
                      onClick: onRemoveImage,
                      variant: 'secondary',
                      isDestructive: true
                    }, __('Remove', 'ucredit'))
                  )
                )
              : el(MediaPlaceholder, {
                  onSelect: onSelectImage,
                  allowedTypes: ['image'],
                  labels: { title: __('Select banner image', 'ucredit') }
                })
          ),

          // Link panel
          el(
            PanelBody,
            { title: __('Banner Settings', 'ucredit') },
            el(TextControl, {
              label: __('Link URL', 'ucredit'),
              value: a.linkUrl || '',
              onChange: (v) => set({ linkUrl: v }),
              placeholder: 'https://example.com'
            }),
            el(TextControl, {
              label: __('Link Label', 'ucredit'),
              value: a.linkLabel || '',
              onChange: (v) => set({ linkLabel: v }),
              placeholder: __('Click me', 'ucredit')
            })
          ),

          // Modal panel
          el(
            PanelBody,
            { title: __('Modal Settings', 'ucredit'), initialOpen: false },

            el(ToggleControl, {
              label: __('Enable Modal on Button', 'ucredit'),
              checked: !!a.showModal,
              onChange: (v) => set({ showModal: !!v })
            }),

            !!a.showModal && el(Fragment, null,
              !formsLoaded && el(Spinner, null),

              formsError && el(Notice, { status: 'warning', isDismissible: false },
                formsError
              ),

              formsLoaded && !formsError && el(SelectControl, {
                label: __('Contact Form', 'ucredit'),
                value: a.cf7FormId || 0,
                options: formOptions,
                onChange: onSelectForm
              }),

              el(TextControl, {
                label: __('Modal ID', 'ucredit'),
                help: __('Used as #id and data-modal value', 'ucredit'),
                value: a.modalId || 'modal',
                onChange: (v) => set({ modalId: (v || 'modal').replace(/\s+/g, '-') })
              })
            )
          )
        ),

        // ===== CANVAS PREVIEW =====
        el('div', blockProps,

          // Image or placeholder (also selectable from canvas)
          a.imageUrl
            ? el('img', { src: a.imageUrl, alt: a.imageAlt || 'banner', className: 'footer__banner_img', style: {
              position: 'relative',
              top: 'unset',
              bottom: '-10px',
              right: 'unset',
              maxWidth: '40%'
            } })
            : el(MediaPlaceholder, {
                onSelect: onSelectImage,
                allowedTypes: ['image'],
                labels: { title: __('Select banner image', 'ucredit') }
              }),

          el('div', { className: 'footer__banner_wrap', style: {
            width: '100%',
            paddingBottom: '2.1875rem',
              maxWidth: '600px',
              marginRight: 'auto',
              textAlign: 'right',
          } },

            el(RichText, {
              tagName: 'h3',
              value: a.title || '',
              onChange: (v) => set({ title: v }),
                placeholder: __('Banner title…', 'ucredit'),
                style: {
                    fontSize: '1.875rem',
                    lineHeight: '1.2',
                    margin: '0 0 1.25rem',
                    color: '#fff'
                }
            }),

            el(RichText, {
              tagName: 'p',
              value: a.description || '',
              onChange: (v) => set({ description: v }),
              placeholder: __('Banner description…', 'ucredit'),
              style: {
                fontSize: '1.125rem',
                margin: '0 0 1.25rem',
                color: '#fff'
              }
            }),

            el('a', {
              className: 'btn btn__bluelight btn__shadow' + (a.showModal ? ' modal-show' : ''),
              href: a.linkUrl || '#',
              onClick: function (e) { e.preventDefault(); },
              ...(a.showModal ? { 'data-modal': a.modalId || 'modal' } : {}),
              style: {
                fontSize: '1.125rem',
                margin: '0 0 1.25rem',
                  color: '#fff',
                backgroundColor: '#5ac4ff',
                border: '1px solid #5ac4ff',
                  color: '#0a1023',
                  borderRadius: '2.5rem',
                cursor: 'pointer',
                transition: 'all .5s ease',
                boxSizing: 'border-box',
                fontFamily: '"OpenSansHebrew Medium", sans-serif',
                fontSize: '1.125rem',
                lineHeight: '1.33em',
                textAlign: 'center',
                padding: '15px',
                borderRadius: '1.625rem',
                textDecoration: 'none',
                display: 'inline-block',
                minWidth: '10rem'
              }
            },
              el(RichText, {
                tagName: 'span',
                value: a.linkLabel || '',
                onChange: (v) => set({ linkLabel: v }),
                placeholder: __('Button', 'ucredit'),
                allowedFormats: []
              })
            )
          )
        )
      );
    },

    save: function () { return null; } // dynamic PHP render
  });
})();
