<?php
// Fungsi untuk merender Tombol Primary
function ButtonPrimary($text, $type = 'button', $onClick = '') {
    $onclickAttr = $onClick ? "onclick=\"$onClick\"" : "";
    return "<button type=\"$type\" $onclickAttr class=\"flex items-center justify-center gap-2 rounded-full bg-[#2d4a22] px-6 py-2.5 text-sm font-bold text-white shadow-md transition-all hover:bg-[#1e3317] active:scale-95\">
        $text
    </button>";
}

// Fungsi untuk merender Tombol Secondary
function ButtonSecondary($text, $type = 'button', $onClick = '') {
    $onclickAttr = $onClick ? "onclick=\"$onClick\"" : "";
    return "<button type=\"$type\" $onclickAttr class=\"flex items-center justify-center gap-2 rounded-full border-2 border-[#2d4a22] bg-white px-6 py-2.5 text-sm font-bold text-[#2d4a22] transition-all hover:bg-[#2d4a22]/5 active:scale-95\">
        $text
    </button>";
}
?>