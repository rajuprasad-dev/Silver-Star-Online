"use strict";

// show profile images
function profile_upload(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#profile_pic_preview').css('background-image', 'url(' + e.target.result + ')');
            $('#profile_pic_preview').hide();
            $('#profile_pic_preview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }

    if (input.files && input.files.length > 1) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#profile_pic_preview').css('background-image', 'url(' + e.target.result + ')');
            $('#profile_pic_preview').hide();
            $('#profile_pic_preview').fadeIn(650);

            var more_image = '<span class="more_image_span"></span>';

            $('.profile_pic_preview').append(more_image);
            $('.more_image_span').html('+' + parseInt((input.files.length) - parseInt(1)) + "<br>more");
            $('.more_image_span').css("display", 'flex');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#profile_upload").change(function() {
    profile_upload(this);
});

// show product images
function product_upload(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#product_pic_preview').css('background-image', 'url(' + e.target.result + ')');
            $('#product_pic_preview').hide();
            $('#product_pic_preview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$("#product_upload").change(function() {
    product_upload(this);
});

// auto active
jQuery(function($) {
    var path = window.location.href;
    $('#sidebarMenu ul.nav li.nav-item a').each(function() {
        if (this.href === path) {
            $(this).parent('.nav-item').addClass('active');

            if ($(this).parent().parent().parent(".multi-level").length > 0) {
                $(this).parent().parent().parent(".multi-level").addClass("show");
            }
        }
    });
});

// CK EDITOR
if (document.getElementById('page_editor')) {
    ClassicEditor
        .create(document.querySelector('#page_editor'), {
            toolbar: {
                items: [
                    'heading',
                    '|',
                    'bold',
                    'underline',
                    'italic',
                    'link',
                    'bulletedList',
                    'numberedList',
                    'FontBackgroundColor',
                    'alignment',
                    'FontColor',
                    'FontFamily',
                    'FontSize',
                    'Heading',
                    'removeFormat',
                    'HorizontalLine',
                    '|',
                    'outdent',
                    'indent',
                    'Strikethrough',
                    'Subscript',
                    'Superscript',
                    'blockQuote',
                    '|',
                    'insertTable',
                    'MathType',
                    'ChemType',
                    'Image',
                    'ImageInsert',
                    'mediaEmbed',
                    'undo',
                    'redo'
                ]
            },
            language: 'en',
            licenseKey: '',
        })
        .then(editor => {
            window.editor = editor;
        })
        .catch(error => {
            console.error(error);
        });
}

// table
$(document).ready(function() {
    $('#details_table').DataTable({
        "responsive": true,
        "searching": true,
        "pagination": true,
        "lengthChange": false,
        "info": true,
        "aaSorting": [],
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#details_table_wrapper .row:eq(0)');
});

// Auto Height Textareas
window.setTimeout(function() {
    $("textarea").not("textarea#test_series_chapters_covered").each(function(textarea) {
        $(this).height($(this)[0].scrollHeight);
    });
}, 1);

// Redirect user to manage user posts
var user_position_select = document.getElementById('user_department_select');
if (user_position_select) {
    user_position_select.onchange = function() {
        if (user_position_select.value == "Add New Department") {
            window.location.href = 'manage_departments';
        }
    };
};

// Redirect user to manage courses
var test_series_course_select = document.getElementById('test_series_course_select');
if (test_series_course_select) {
    test_series_course_select.onchange = function() {
        if (test_series_course_select.value == "Add More Courses") {
            window.location.href = 'manage_courses_list';
        }
    };
};

// show name when something attached
if ($('#file_attachment')) {
    $('#file_attachment').on('change', function(evt) {
        $("#attachment_file_name").html(evt.target.files[0].name);
    });
}

$("select").on("change", function() {
    $(this).css("color", "#000");
})

// load mcq results in popup
// $(document).ready(function(){
//     $(document).on('click','.view_mcq_result_data', function(){
//         var dataURL = $(this).attr('data-href');

//         $('.result_detail_body').load(dataURL,function(){
//             setTimeout(function () {
//                 setTimeout(async function () {
//                     await MathJax.typesetPromise()
//                 }, 100)
//             }, 0),
//             $('#view_result_detail').modal({
//               show:true
//             });
//         });
//     }); 
// });

// coloris
Coloris({
    // parent container
    parent: null,
    format: 'hex',
    // The bound input fields are wrapped in a div that adds a thumbnail showing the current color
    // and a button to open the color picker (for accessibility only).
    wrap: true,
    // Margin in px
    margin: 2,
    a11y: {
        open: 'Open color picker',
        close: 'Close color picker',
        marker: 'Saturation: {s}. Brightness: {v}.',
        hueSlider: 'Hue slider',
        alphaSlider: 'Opacity slider',
        input: 'Color value field',
        swatch: 'Color swatch',
        instruction: 'Saturation and brightness selector. Use up, down, left and right arrow keys to select.'
    },
    swatches: [
        '#264653',
        '#2a9d8f',
        '#e9c46a',
        '#f4a261',
        '#e76f51',
        '#d62828',
        '#023e8a',
        '#0077b6',
        '#0096c7',
        '#00b4d8',
        '#48cae4',
    ]
});

if ($(".print_btn").length > 0) {
    $(".print_btn").click(function(e) {
        e.preventDefault();

        window.print();
    });
}

function formatState(opt) {
    if (!opt.id) {
        return opt.text.toUpperCase();
    }

    var optimage = $(opt.element).attr('data-image');
    console.log(optimage)
    if (!optimage) {
        return opt.text.toUpperCase();
    } else {
        var $opt = $(
            '<span><img src="' + optimage + '" width="60px" /> ' + opt.text.toUpperCase() + '</span>'
        );
        return $opt;
    }
};

$(".multiple_image_select").select2({
    templateResult: formatState,
    templateSelection: formatState,
    placeholder: {
        id: '-1',
        text: $(".multiple_image_select").attr("data-holder")
    }
});


if ($('#sales_report').length > 0) {
    $(document).ready(function() {
        var sales_report = $('#sales_report').DataTable({
            "responsive": true,
            "searching": true,
            "pagination": true,
            "lengthChange": false,
            "info": true,
            "aaSorting": [],
            "dom": 'fBrtip',
            "buttons": [{
                    extend: 'pdfHtml5',
                    orientation: 'landscape',
                    pageSize: 'LEGAL',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                {
                    extend: 'csvHtml5',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                {
                    extend: 'copy',
                    exportOptions: {
                        columns: ':not(:last-child)',
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: 'th:not(:last-child)'
                    }
                },
                "colvis"
            ]
        });

        var minDate = $("#min");
        var maxDate = $("#max");

        // Refilter the table
        $('#min, #max').change(function(e) {
            e.preventDefault();
            sales_report.draw();
        });

        $('#min, #max').keyup(function(e) {
            e.preventDefault();
            sales_report.draw();
        });

        // Custom filtering function which will search data in column four between two values
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var min = minDate.val();
                var max = maxDate.val();
                var date = new Date(data[6]);

                // console.log(min);
                // console.log(max);
                // console.log(date);

                if ((min === '' && max === '') ||
                    (min === '' && date <= max) ||
                    (min <= date && max === '') ||
                    (min === undefined && max === undefined) ||
                    (min === undefined && date <= max) ||
                    (min <= date && max === undefined) ||
                    (min === null && max === null) ||
                    (min === null && date <= max) ||
                    (min <= date && max === null) ||
                    (min <= date && date <= max)
                ) {
                    return true;
                }
                return false;
            }
        );

        // Create date inputs
        minDate = new DateTime($('#min'), {
            format: 'DD MMMM YYYY'
        });
        maxDate = new DateTime($('#max'), {
            format: 'DD MMMM YYYY'
        });
    });
}