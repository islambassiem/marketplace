<?php

$maxNumber = env('MAX_UPLOAD_NUMNER', 5);
$maxSize = env('MAX_UPLOAD_SIZE', 2048) / 1024;

return [
    "The title is required." => "العنوان مطلوب.",
    "The title cannot be longer than 255 characters." => "العنوان لا يمكن ان يتجاوز 255 حرف.",
    "The description is required." => "التفاصيل مطلوبة.",
    "The description cannot be longer than 65,535 characters." => "التفاصيل لا يمكن ان يتجاوز 65,535 حرف.",
    "The price is required." => "السعر مطلوب.",
    "The price must be a number." => "السعر يجب ان يكون رقم.",
    "The price cannot be negative." => "السعر لا يمكن ان يكون سالب.",
    "Please select a category." => "يرجى اختيار قسم.",
    "The selected category is invalid." => "القسم المحدد غير صالح.",
    "Please select a city." => "يرجى اختيار مدينة.",
    "The selected city is invalid." => "المدينة المحددة غير صالحة.",
    "Please upload at least one image." => "يرجى تحميل صورة واحدة على الاقل.",
    "The images must be in an array format." => "الصور يجب ان تكون في صيغة مصفوفة.",
    "You can upload up to $maxNumber images only." => "يمكنك تحميل حتى $maxNumber صور فقط.",
    "The uploaded file must be an image." => "ملف المحمل يجب ان يكون صورة.",
    "Images must be of type => jpeg, png, jpg, gif, or svg." => "الصور يجب ان تكون من نوع jpeg, png, jpg, gif, او svg.",
    "Each image must not be larger than $maxSize MB." => "لا يمكن ان يكون كل صورة اكبر من $maxSize MB.",
    "The selected province is invalid." => "المقاطعة المحددة غير صالحة.",
    "This is the only image; you cannot deleted it" => "هذه هي الصورة الوحيدة; لا يمكنك حذفها",
    "Images must be of type: jpeg, png, jpg, gif, or svg." => "الصور يجب ان تكون من نوع jpeg, png, jpg, gif, او svg.",
];
