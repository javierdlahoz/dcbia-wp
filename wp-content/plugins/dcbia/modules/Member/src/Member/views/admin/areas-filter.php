<?php
$values = array(
    "Evaluation Capacity Building" => "Evaluation Capacity Building",
    "Basic Evaluation Methods" => "Basic Evaluation Methods",
    "Sustainability & Equity" => "Sustainability & Equity",
    "Systems-Oriented Evaluation" => "Systems-Oriented Evaluation"
);
?>
<select name="ADMIN_FILTER_FIELD_VALUE_AREAS">
<option value=""><?php _e('Filter By ', 'wose45436'); ?></option>
<?php
    $current_v = isset($_GET['ADMIN_FILTER_FIELD_VALUE_AREAS'])? $_GET['ADMIN_FILTER_FIELD_VALUE_AREAS']:'';
    foreach ($values as $label => $value) {
        printf
            (
                '<option value="%s"%s>%s</option>',
                $value,
                $value == $current_v? ' selected="selected"':'',
                $label
            );
        }
?>
</select>
