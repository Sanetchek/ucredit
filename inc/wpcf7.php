<?php

// Validate CF7 tel* to exactly 10 digits for the field "modal_phone"
add_filter('wpcf7_validate_tel*', function ($result, $tag) {
    if ($tag->name !== 'modal_phone') {
        return $result;
    }

    $submission = WPCF7_Submission::get_instance();
    if (!$submission) {
        return $result;
    }

    $data = $submission->get_posted_data();
    $value = isset($data[$tag->name]) ? $data[$tag->name] : '';
    $digits = preg_replace('/\D+/', '', $value);

    if (strlen($digits) !== 10) {
        $result->invalidate($tag, __('הזן בדיוק 10 ספרות של מספר הטלפון', 'ucredit'));
    }

    return $result;
}, 20, 2);
