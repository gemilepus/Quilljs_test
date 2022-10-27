<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TEST</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.6/css/all.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/main.css">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/quill/2.0.0-dev.3/quill.snow.min.css" rel="stylesheet">
    <link href="https://unpkg.com/quill-better-table@1.2.8/dist/quill-better-table.css" rel="stylesheet">

    <script src='https://code.jquery.com/jquery-latest.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.37/vue.global.prod.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/quill/2.0.0-dev.3/quill.min.js" type="text/javascript"></script>
    <script src="js/quill-better-table-1.2.10.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/T-vK/DynamicQuillTools@master/DynamicQuillTools.js"></script>
</head>
<?php
require 'vendor/autoload.php';

?>

<body>
    <div class="page-wrapper chiller-theme toggled">
        <a id="show-sidebar" class="btn btn-sm btn-dark">
            <i class="fas fa-bars"></i>
        </a>
        <nav id="sidebar" class="sidebar-wrapper">
            <div class="sidebar-content">
                <div class="sidebar-brand">
                    <a href="#">quilljs test</a>
                    <div id="close-sidebar">
                        <i class="fas fa-times"></i>
                    </div>
                </div>
            </div>
        </nav>

        <!-- sidebar-wrapper  -->
        <main class="page-content">
            <div id="container" style="margin: 0 auto;">

                <div id="b4_news" class="box grid-item" style="height: 350px;">

                    <ul class="list-group" style="margin: 5px;height: 85%;">

                        <nav style="display: flex;justify-content: space-between;">

                            <div class="nav nav-tabs" id="nav-tab" role="tablist" style="overflow-x: auto;overflow-y: hidden;flex-wrap: nowrap;margin-right: 10%">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">{{ ItemName }}</button>

                            </div>

                            <button type="button" class="btn btn-primary" v-on:click="plus">Add</button>

                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <table class="table">
                                    <thead>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(item, key) in data" :key="key" v-on:click="clickList(item)">
                                            <td>{{ item.name }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
                            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
                        </div>

                    </ul>

                    <nav>
                        <ul class="pagination" style="justify-content: space-between;">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                                    < </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="#"> ></a>
                            </li>
                        </ul>
                    </nav>

                    <!-- Modal -->
                    <div class="modal" id="QuillModal" tabindex="99999" aria-labelledby="QuillModalLabel" aria-hidden="true" data-bs-backdrop="false">
                        <div class="modal-dialog modal-fullscreen">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="QuillModalLabel"></h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <div class="form-group" v-if="!isRead" style="width: 100%;max-width: 960px;margin: 0px auto;">
                                        <label for="name" class="form-label" style="float: left;">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Name" v-model="name" />
                                    </div>

                                    <div class="form-group" v-if="!isRead" style="width: 100%;max-width: 960px;margin: 0px auto;">
                                        <label for="title" class="form-label" style="float: left;">Title</label>
                                        <input type="text" class="form-control" name="title" placeholder="Title" v-model="title" />
                                    </div>

                                    <div id="editor" style="width: 100%;max-width: 960px;margin: 0 auto;border: 1px #ddd solid;">
                                    </div>

                                    <div class="input-group" v-if="!isRead" style="width: 100%;max-width: 960px;margin: 0px auto;">
                                        <label class="input-group-text" for="file">Files</label>
                                        <input type="file" class="form-control" name="file[]" id="file" multiple>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button id="clickSubmit" class="btn btn-success" onclick="b4_news.clickSubmit()" v-if="!isRead">Upload</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <script>
                    Quill.register({
                        'modules/better-table': quillBetterTable
                    }, true)

                    var toolbarOptions = [
                        ['bold', 'italic', 'underline', 'strike'], // toggled buttons
                        ['blockquote', 'code-block'],

                        [{
                            'header': 1
                        }, {
                            'header': 2
                        }], // custom button values
                        [{
                            'list': 'ordered'
                        }, {
                            'list': 'bullet'
                        }],
                        [{
                            'size': ['small', false, 'large', 'huge']
                        }], // custom dropdown
                        ['link', 'image', 'video'], // add's image support
                        [{
                            'color': []
                        }, {
                            'background': []
                        }], // dropdown with defaults from theme
                        [{
                            'font': []
                        }],
                        [{
                            'align': []
                        }],
                        ['clean'] // remove formatting button
                    ];

                    let quill;
                    $(document).ready(function() {

                        quill = new Quill('#editor', {
                            modules: {
                                toolbar: toolbarOptions,
                                table: false,
                                'better-table': {
                                    operationMenu: {
                                        color: {
                                            colors: ['rgb(0, 255, 255)', 'rgb(0, 255, 0)',
                                                'rgb(255, 255, 0)',
                                                'rgb(255, 128, 0)', 'rgb(255, 0, 0)', 'rgb(255, 0, 255)'
                                            ],
                                        }
                                    }
                                },
                            },
                            theme: 'snow'
                        });

                        const addTableButton = new QuillToolbarButton({
                            icon: `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--! Font Awesome Pro 6.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2022 Fonticons, Inc. --><path d="M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm88 64v64H64V96h88zm56 0h88v64H208V96zm240 0v64H360V96h88zM64 224h88v64H64V224zm232 0v64H208V224h88zm64 0h88v64H360V224zM152 352v64H64V352h88zm56 0h88v64H208V352zm240 0v64H360V352h88z"/></svg>`
                        })
                        addTableButton.onClick = function(quill) {
                            let tableModule = quill.getModule('better-table')
                            tableModule.insertTable(3, 3)
                        }
                        addTableButton.attach(quill);

                    });

                    var b4_news = Vue.createApp({
                        data() {
                            return {
                                isRead: true,
                                ItemName: 'NEWS',
                                data: [
                                    <?php

                                    use Symfony\Component\Finder\Finder;

                                    $finder = new Finder();
                                    $finder->in("news");

                                    foreach ($finder as $file) {
                                        echo "{name:'" . $file->getRelativePathname() . "'},";
                                    }
                                    ?>
                                ]
                            }
                        },
                        methods: {
                            clickList: function(item) {

                                this.isRead = true;
                                $(".ql-toolbar").hide();

                                $.ajax({
                                    url: 'news/' + item.name,
                                    success: function(data) {
                                        console.log(data);
                                        quill.root.innerHTML = data;

                                        $('#QuillModal').modal('show')
                                    }
                                })
                            },
                            plus: function() {

                                this.isRead = false;
                                $(".ql-toolbar").show();
                                $('#QuillModal').modal('show')

                            },
                            clickSubmit: function() {

                                var justHtml = quill.root.innerHTML;

                                var formData = false;
                                if (window.FormData) {
                                    formData = new FormData();
                                }
                                var filedata = document.getElementById("file"),
                                    i = 0,
                                    len = filedata.files.length,
                                    img, reader, file;
                                for (; i < len; i++) {
                                    file = filedata.files[i];

                                    if (window.FileReader) {
                                        reader = new FileReader();
                                        reader.onloadend = function(e) {
                                            //showUploadedItem(...);
                                        };
                                        reader.readAsDataURL(file);
                                    }
                                    formData.append("file[]", file);

                                }
                                formData.append("name", this.name);
                                formData.append("title", this.title);
                                formData.append("news", justHtml);

                                $.ajax({
                                    type: "POST",
                                    url: "editorapi.php",
                                    data: formData,
                                    processData: false,
                                    contentType: false
                                }).done(function(data) {
                                    console.log(data);
                                    alert("OK")

                                    location.reload();
                                });

                            }

                        },
                        created: function() {

                        }

                    }).mount('#b4_news');
                </script>

            </div>
            <div class="container-fluid">

            </div>

        </main>
        <!-- page-content" -->
    </div>
    <!-- page-wrapper -->
    <script>
        jQuery(function($) {

            $(".sidebar-dropdown > a").click(function() {
                $(".sidebar-submenu").slideUp(200);
                if (
                    $(this)
                    .parent()
                    .hasClass("active")
                ) {
                    $(".sidebar-dropdown").removeClass("active");
                    $(this)
                        .parent()
                        .removeClass("active");
                } else {
                    $(".sidebar-dropdown").removeClass("active");
                    $(this)
                        .next(".sidebar-submenu")
                        .slideDown(200);
                    $(this)
                        .parent()
                        .addClass("active");
                }
            });

            $("#close-sidebar").click(function() {
                $(".page-wrapper").removeClass("toggled");
            });
            $("#show-sidebar").click(function() {
                $(".page-wrapper").addClass("toggled");
            });

            let $container = $('#container');

            $container.masonry({
                isFitWidth: true,
                columnWidth: 5,
                animate: true
            });
        });
    </script>

</body>

</html>