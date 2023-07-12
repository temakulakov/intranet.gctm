<?
$arResult['funcGetInputHtml'] = function ($question, $arrVALUES, $FIELD_SID) {
    global $USER;
    $email = $USER->GetEmail();
    $id = $question['STRUCTURE'][0]['ID'];
    $type = $question['STRUCTURE'][0]['FIELD_TYPE'];
    $name = "form_{$type}_{$id}";
    $value = isset($arrVALUES[$name]) ? htmlentities($arrVALUES[$name]) : '';
    $required = $question['REQUIRED'] === 'Y' ? 'required' : '';
    $class = ' ' . $question['STRUCTURE'][0]['FIELD_PARAM'];
    $placeholder = $question['CAPTION'];
    switch ($type) {
        case 'textarea':
            $input =
                "<div class=\"form__item\">
                    <label class=\"textarea\">
                        <textarea placeholder=\"{$placeholder}\"name=\"{$name}\" {$required}>{$value}</textarea>
                        <p>{$placeholder}</p>
                    </label>
                </div>";
            break;
        case 'file':
            $input =
                "<div class=\"form__item\">
                    <label for=\"{$name}\">
                        <svg width=\"20\" height=\"22\" viewBox=\"0 0 20 22\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\">
                            <path
                                d=\"M12.9997 5.99996L6.4997 12.5C6.10188 12.8978 5.87838 13.4374 5.87838 14C5.87838 14.5626 6.10188 15.1021 6.4997 15.5C6.89753 15.8978 7.43709 16.1213 7.9997 16.1213C8.56231 16.1213 9.10188 15.8978 9.4997 15.5L15.9997 8.99996C16.7954 8.20432 17.2423 7.12518 17.2423 5.99996C17.2423 4.87475 16.7954 3.79561 15.9997 2.99996C15.2041 2.20432 14.1249 1.75732 12.9997 1.75732C11.8745 1.75732 10.7954 2.20432 9.9997 2.99996L3.4997 9.49996C2.30623 10.6934 1.63574 12.3121 1.63574 14C1.63574 15.6878 2.30623 17.3065 3.4997 18.5C4.69318 19.6934 6.31188 20.3639 7.9997 20.3639C9.68753 20.3639 11.3062 19.6934 12.4997 18.5L18.9997 12\"
                                stroke=\"#111111\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\" />
                        </svg>
                        Прикрепить файл
                    </label>
                    <input type=\"file\" name=\"{$name}\" id=\"{$name}\" value=\"{$value}\" {$required}>
                </div>
                <p>Не более 3-х файлов до 5 MB форматов: png, jpg, pdf</p>";
            break;
        case 'dropdown':
            $name = "form_{$type}_{$FIELD_SID}";
            $input =
                "<div class=\"form__item\">
                    <select class=\"select\" name=\"{$name}\" id=\"\">
                        <option value=\"\">{$placeholder}</option>";
            foreach ($question['STRUCTURE'] as $option) {
                $input .= '<option value="' . $option['ID'] . '">' . $option['MESSAGE'] . '</option>';
            }
            $input .=
                "</select>
                </div>";
            break;
        case 'hidden':
            if ($FIELD_SID == 'SENDER') {
                $value = $email;
            }
            $input = "<input type=\"hidden\" name=\"{$name}\" value=\"{$value}\" {$required} data-name=\"{$FIELD_SID}\">";
            break;
        default:
            $input = "<input type=\"{$type}\" name=\"{$name}\" value=\"{$value}\" {$required}>";
            break;
    }

    return $input;
};
