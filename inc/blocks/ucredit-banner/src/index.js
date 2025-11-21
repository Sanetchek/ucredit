/* global wp */
(function () {
  const {
    registerBlockType
  } = wp.blocks;
  const {
    __
  } = wp.i18n;
  const el = wp.element.createElement;
  const Fragment = wp.element.Fragment;
  const {
    useBlockProps,
    InspectorControls,
    RichText
  } = wp.blockEditor || wp.editor;
  const {
    PanelBody,
    TextControl,
    ToggleControl
  } = wp.components;

  registerBlockType('ucredit/banner', {
    edit: function (props) {
      const a = props.attributes;
      const set = props.setAttributes;
      const blockProps = useBlockProps({
        className: 'footer__banner'
      });

      return el(
        Fragment,
        null,
        // Sidebar controls
        el(
          InspectorControls,
          null,
          el(
            PanelBody, {
              title: __('Banner Settings', 'ucredit')
            },
            el(TextControl, {
              label: __('Link URL', 'ucredit'),
              value: a.linkUrl || '',
              onChange: (v) => set({
                linkUrl: v
              }),
              placeholder: 'https://example.com'
            }),
            el(TextControl, {
              label: __('Link Label', 'ucredit'),
              value: a.linkLabel || '',
              onChange: (v) => set({
                linkLabel: v
              }),
              placeholder: __('Click me', 'ucredit')
            })
          ),
          el(
            PanelBody, {
              title: __('Modal Settings', 'ucredit'),
              initialOpen: false
            },
            el(ToggleControl, {
              label: __('Enable Modal on Button', 'ucredit'),
              checked: !!a.showModal,
              onChange: (v) => set({
                showModal: !!v
              })
            }),
            el(TextControl, {
              label: __('Modal ID', 'ucredit'),
              help: __('Used as #id and data-modal value', 'ucredit'),
              value: a.modalId || 'modal',
              onChange: (v) => set({
                modalId: (v || 'modal').replace(/\s+/g, '-')
              })
            }),
            el(TextControl, {
              label: __('CF7 Shortcode', 'ucredit'),
              value: a.cf7Shortcode || '',
              onChange: (v) => set({
                cf7Shortcode: v
              })
            })
          )
        ),

        // Canvas preview (keeps your classes)
        el('div', blockProps,
          el('div', {
              className: 'footer__banner_wrap'
            },
            el(RichText, {
              tagName: 'h3',
              value: a.title || '',
              onChange: (v) => set({
                title: v
              }),
              placeholder: __('Banner title…', 'ucredit')
            }),
            el(RichText, {
              tagName: 'p',
              value: a.description || '',
              onChange: (v) => set({
                description: v
              }),
              placeholder: __('Banner description…', 'ucredit')
            }),
            el('a', {
              className: 'btn btn__bluelight btn__shadow' + (a.showModal ? ' modal-show' : ''),
              href: a.linkUrl || '#',
              onClick: (e) => e.preventDefault(),
              ...(a.showModal ? {
                'data-modal': a.modalId || 'modal'
              } : {})
            }, a.linkLabel || __('Button', 'ucredit'))
          )
        )
      );
    },
    save: function () {
      return null;
    } // dynamic render via PHP
  });
})();
