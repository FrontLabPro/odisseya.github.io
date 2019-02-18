<?php

defined('JPATH_BASE') or die();

jimport('joomla.form.formfield');

class JFormFieldImport extends JFormField
{
	var $type = 'import';

	function getInput() {
        ob_start();
        $root = dirname(dirname((JURI::current())));
        $action = $root . '/plugins/content/themlerexportimport/core/index.php?action=import';
        ?>
        <style type="text/css">
            #file-list {
                list-style-type: none;
                margin: 0;
                padding: 0;
            }
            #file-list li {
                margin: 10px;
                width: 152px;
                text-align: center;
                display: inline-block;
            }

            #file-list div.progress {
                width: 150px;
                border: 1px solid #888888;
                height: 18px;
                text-align: center;
                background-image: url('<?php echo $root; ?>/plugins/content/themlerexportimport/fields/pbar_bgr.png');
                background-repeat: no-repeat;
                background-position: -150px center;
            }

            #log {
                color: blue;
            }

        </style>
        <input type="file" name="file" id="file-field" multiple="true" />
        <button id="upload-all" disabled class="btn"><?php echo JText::_('PLG_CONTENT_THEMLEREXPORTIMPORT_IMPORTBUTTON_TEXT'); ?></button>
        <ul id="file-list"></ul>
        <div id="log"></div>
        <script>
            jQuery(function($) {

                var fileInput = $('#file-field');
                var fileList = $('ul#file-list');
                var uploadBtn = $("#upload-all");
                var replaceChbx = $('input[id*="replacecontent"]');
                var previousContentData = $('input[id*="idsData"]');

                var replaceStatus = replaceChbx[0].checked ? 'yes' : 'no';

                replaceChbx.click(function() {
                    replaceStatus = this.checked ? 'yes' : 'no';
                });

                function log(msg, color) {
                    $('#log').append($('<div></div>').text(msg).css('color', color));
                    setTimeout(function(){
                        $('#log').html('');
                    }, 2000)
                }

                function ChunkedUploader(file, params) {
                    var _file = file;
                    if (_file instanceof Uint8Array) {
                        _file = new Blob([_file]);
                    }
                    var CHUNK_SIZE = 1024 * 1024; // 1 Mb
                    var uploadedChunkNumber = 0, allChunks;
                    var fileName = (_file.name || window.createGuid()).replace(/[^A-Za-z0-9\._]/g, '');
                    var fileSize = _file.size || _file.length;
                    var total = Math.ceil(fileSize / CHUNK_SIZE);

                    var rangeStart = 0;
                    var rangeEnd = CHUNK_SIZE;
                    validateRange();

                    var sliceMethod;

                    if ('mozSlice' in _file) {
                        sliceMethod = 'mozSlice';
                    }
                    else if ('webkitSlice' in _file) {
                        sliceMethod = 'webkitSlice';
                    }
                    else {
                        sliceMethod = 'slice';
                    }

                    this.upload = upload;

                    function upload() {
                        var data;

                        setTimeout(function () {
                            var requests = [];

                            for (var chunk = 0; chunk < total - 1; chunk++) {
                                data = _file[sliceMethod](rangeStart, rangeEnd);
                                requests.push(createChunk(data));
                                incrementRange();
                            }

                            allChunks = requests.length;

                            $.when.apply($, requests).then(
                                function success() {
                                    var lastChunkData = _file[sliceMethod](rangeStart, rangeEnd);

                                    createChunk(lastChunkData, {last: true})
                                        .done(onUploadCompleted)
                                        .fail(onUploadFailed);
                                },
                                onUploadFailed
                            );
                        }, 0);
                    }

                    function createChunk(data, params) {
                        var formData = new FormData();
                        formData.append('filename', fileName);
                        formData.append('replaceStatus', replaceStatus);
                        formData.append('chunk', new Blob([data], { type: 'application/octet-stream' }), 'blob');

                        if (typeof params === 'object') {
                            for (var i in params) {
                                if (params.hasOwnProperty(i)) {
                                    formData.append(i, params[i]);
                                }
                            }
                        }

                        return $.ajax({
                            url: '<?php echo $action; ?>',
                            data: formData,
                            type: 'POST',
                            mimeType: 'application/octet-stream',
                            processData: false,
                            contentType: false,
                            headers: (rangeEnd <= fileSize) ? {
                                'Content-Range': ('bytes ' + rangeStart + '-' + rangeEnd + '/' + fileSize)
                            } : {},
                            success: onChunkCompleted,
                            error: function (xhr, status) {
                                alert('Failed  chunk');
                            }
                        });
                    }

                    function validateRange() {
                        if (rangeEnd > fileSize) {
                            rangeEnd = fileSize;
                        }
                    }

                    function incrementRange() {
                        rangeStart = rangeEnd;
                        rangeEnd = rangeStart + CHUNK_SIZE;
                        validateRange();
                    }

                    function onUploadCompleted(response, status, xhr) {
                        previousContentData.val(response);
                        params.complete();
                    }

                    function onUploadFailed(xhr, status) {
                        alert('onUploadFailed');
                    }

                    function onChunkCompleted() {

                        if (uploadedChunkNumber >= allChunks)
                            return;

                        ++uploadedChunkNumber;
                        params.progress(Math.round((100 * uploadedChunkNumber)/allChunks));
                    }
                }

                function updateProgress(bar, value) {
                    var width = bar.width();
                    var bgrValue = -width + (value * (width / 100));
                    bar.attr('rel', value).css('background-position', bgrValue+'px center').text(value+'%');
                }

                function displayFiles(files) {
                    var imageType = /(zip).*/;
                    var num = 0;

                    $.each(files, function(i, file) {

                        if (!file.type.match(imageType)) {
                            alert('File is not allowed: `'+file.name+'` (type '+file.type+')');
                            fileInput.val('');
                            fileList.html('');
                            uploadBtn.attr('disabled', true);
                            return true;
                        }
                        num++;
                        var li = $('<li/>');
                        var img = $('<img/>').appendTo(li);
                        $('<div/>').addClass('progress').attr('rel', '0').text('0%').appendTo(li);
                        li.get(0).file = file;
                        fileList.html(li);
                        var thumbDataUrl = "data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAYAAADDPmHLAAAPQElEQVR42u1de4wkRRm/fdzd3u5xdzwOUUMUQUIIhAAaCV7Y2Znt7qruud2d6arag0MwxMNEReWEeIDhNJ5AgpqYaIJG5SUoXnxwAiGIqBEjCALCP0pABATJKREI8ua0qnvmprq7uqf6MTPVMzXJF8Lczq+/7u/XVV999auqFSv0R3/yfObnK2PUxjkb03jDg9ftYhNh03jDg9eNZZPUVnI2mZVtGk8tPJmLsQus4mxlTuc1niJ4MhdbTW2Ks9U5ndd4iuDJXIxdYA1nUzmd13iK4HW7GMsmp6nNcMb+f1zjlR9P5mLsAms5m8npvMZTBE/2Yus4W5vT+bUaTw08mT5mun1BAOrHWcDdZdnk+xYk12Sway2IbqB2I2c3+N+XDM/G7BlcZNv4sC7BYgFaz9m6nMEvDK8d424JhtfUWLCBTYBfocH/X3bDAis93gsAoNmyBb8V3wnh77mhBcsqZwyjfrhhuy/p4IvNAOS/BkTVkgV/UkgArqjQHl7MWLD5MR38ZDMBecWEyChJ8NuVQiEBJluVpDYBpmlf93kdfBlDr5p2s6F48FdzlcKJQA7Q+mIlRwBm46aNd+jgy+EZNn7NAC5SMPjjXEz3E0CUFLQJsL+cmI0Aoxf8thkAv24ClygW/GmuUsjiOyn6owmuf9jfNKQnwOgGv0MC8roJyZIiwW9XCtsEiE4UcQSITCF2I4Bpk50AkFMAwKdaVqNGbZ6zGvve//d4MyH+ctLDNW33z2nwxJbdv7YZNtkrTyb0hmUvNwccfL5SuCZ2oogjQOQfuxEA2PjMPM7PLi5usAB6rtubZYLGRwfdrNJs/x8pW5I3gbOMBxR8vlI4kzhRlDSDJEGAj+RxnrYgX5NqVm3y9Ozs2VODbFY7BJDvRmh38Bb999MHVDFsE2A68yxh1xwANrdldZ6VUtnwSb5ZxZ8eZJ/qEyB9DsFIQH+7dQAVw3W5J4qSCYAZAc7N6jzFvixNgkYf5N8xxhOD6lNNgJ/JXjFEb9PE8Kw+VwzzTxTFEwCHCZDKeRrIVcGkSu7NoiTYPKg+lRLg2TyjB48EAJ9ThomiLgTAYQKkvhhwUCPL0Iy+RT8dUEK1PkiAzEPHfSZonleK4IsJgMME2JYpoYL4h1nG5bTVeA2AresGMQXbIUDuusE+CzTPVz74UQJEg8VGAWkxveYfkJeyF2UwGcQUrJ8DFFc0oi3BBUoHP0gAcbBYHSAtpuWQas6K3PcGMf8erAMUVIGE6DPKBr9FgIuSgpWWAF42DdFlIjzWvNP/7maVQWrfsgB5UtwNoMcGMf+enQCJZN9H7/s0JYPvB8u9NOlNTUOAtvOW7d4RxqNEe8Cylt/L//3JJ5+70oLkCtFDrddPP6Tf2XQ2AnRv6SjZf6xi8D1NYJQAJBMBkrJpE6B/AYA2xv2W5gvXRecgcK3fQynLRk/1YuKJkV9ZTWCQACQTAXjnDaN6qJcF83iQ7Er6PYTLR0crkI1P9nsoRa/7o57MOkL0kLKawA4BSCYChJ0HYPPRUbzlxa6Jo01e4B+uCZs7+z2ONk10EL32D2hu8jirSsYbfoo3C+Cnk8vp8QQYuCbQJwDJRACR8xAuHhHB6D5jNsbEl4E3CzQvVlR5E8GrVLZMZyGAEppAfxSQngBxzp9wwnETfg0gkARdlTwSWT41WoF0zyxD8Nn3bBYzLQFKowkUEaCb8wYkt4Sre6ZDThA57o0EbHR3SHb1lmnW31eG4Huah5QEKJUmMEwAGecNgJCgxLvXctBCcLq4+R4a8DuiyVTztrIEPy0BSqcJ5Akg6/zOnTvHDRv9UYgJyJMmRLfTQN/HZs8E2fSbpoNPLEvw0xCglJrANgHSOj/vNN9Pf/98asGljbeXKfiyBBhJTaBVJyfRhPCfMsE3gPu2BcnFZQt+CgKMpibQMBqHmpBc7WvnYt58gB8GwJ0rY/DlCOA+MpKawIDjC1veZQL0CRO611DMW2gesJva5Uy6XaaELz0BcJgAo6MJVDFYvcCLJwAOE2B0NIGjEvx4AuAwAUZLEzgqwRcTAIsIMFqaQJHzhmEfRTPib5o2uZsJQ9IIJVQmU5AAglnCLrOBA9UH9EITKHK+ZsMjDNt9UqCld8veknQIECsLe0jJ4AcJUJwmUOS8BdAVMfKvJ8rejfizgQn6gJQEKL0mUCi4hGRP3GiDLSAtcw5RrTobE8UhKQgwFJpAkfPhGcKw/q/MCWS1ar8jURkkSYCh0QSKnKfYv4gjQG1p6eAyjx6CBCCZCDA0msB4wSW+NmYt4OtME1DmoWOHAFoTGOs8AMs18cMh15S9bmAYtUOY6CXO6D3e2+fgD04TmOS8CdGnOto/byHozQsLCweMUtGoD8EfrCawm/Ns4SfTABqb0REjHqzh1QTqYA0ETx1NoA5W3/HU0gQmfRBCa5hCmO0fpIM/xJpAYRII8DmGjV5sr5q1bPQTyzLeqYOfGU/9fQI7yR+a9YMe2iQSutfq4GfGU18T2BkCkqvFs47uq5WKfVBqPBMdxdYfMP/YlDXTLXC2jX3PyJvB1Mez0VnzcPNJpdIEdkrB0Ymn2uLCRlkcljuYNrpV713stZ53zjuNo0qhCTQguTXuYcRNBkVbMryeBv+vOvi8opo87jhnHNgDAhSrCTT81UDChyFLgOBuIjr4XDn96wUToHhNoAXd2+MeBluXL9WK2OgJHXzBDqs2ebZAAvRGE2hC9B3hwwDkP2wtoVweQfbp4IvxwjOqGQnQO02gYW/+oCE4mo726ZfI4ungx+Nl2Wk9RIDeagK9bqDuftgC+B5vVTBEz9DhzIX0z8ekuxEd/J4QoC+awFA3MpYFTwe/YAL0UxNYRDeS5eEagNxkOuSzLTvftN0d1C7ibIf3fedvPKMt1HY6cvllzB4Hj7I1DabZPMQAS3V/k6iYYAF0F2vpwvjta5g2+QrzkR2YkYdMqQnQb01gEd1Ihjdrd07/xmiO8gfBGYJOsGVyzxE/P7Qn1ctoL80njZbSEkApTWBnKLflQ74yCKE41sbmEGlP/LTJzrzkpGPsb0eeCcCnBnYZt5uLwh1CbXxBppYONj7OjqdLc6/8s1RSE+i9TYH5AH9P4DTKoNR9KST3Oo69NmvwDePMGYrxtwiuv6R9PUeAhZgdQi/InDDb6IwsBFBWE2g4+OyYh3SnLF7GhGovfZi/pX39b3xD1PCv2HV5E21mSYN/pTBBsxrzgWA52JQhgLd3EsA/b5sJ8W6aB3zDspYc4d7FkNychgBKawLZhslxJ2wwkYictLw32TRNwP4CAFgdnL7ecmJwVxMOr0MAv2VyyLwMAWZnZyfjK67o+vD90i5sTvZeK5Wta5TWBCatDHKc5UMl9/LtxVAqsp07O7iKZvr3x+L5BOi0TJkIEPWP5kZbw3/Pq6iTrFpd3KC0JjCJAGx7WRm8XoyjaTP73WjTj7Yn4oW2tUlPgDj/0M8ivgD0iMz9VqsLByqtCWSHQcU7D98tg1d4EQWg58JTqf7mlejlxPI4HQUE/JIkwNzc7Kok/2iT/7voPbNdVLvfL0cANTWB7OgUsfPuA7J4RVfQgEO2CIQrt3XDY+cMpyUAu69arXJgF//uiFZqRXWIqH8tAqirCfQOkoL41wHnAX5hHjQr0vsOFhh8piqK6BYpIWTw0hKg/fwoAQ7usop4u6ALeE7mfls5gLqawHYf6Gvk3Kss4H5p3l48JlVRprDaOXqZNfU8NusKOg87GS8NAfiXJ0iAiE97wlO6AKBjZe+XjQKU1gQW0o0UNREjeNNYMiiLl4IAFwYqfFbtIEqy+9iMKGvaWYvIrmvAZShbhYzzr4DpYPX3CSwk+HR4Fz6fuCNZl8OTJgB0L8lMdodY/mbacvfbAwKot09g3uCzwg4r8ASDD1b7QlN5PDkCeMfefCHT9roAoej4P9m/ggmg5j6B+eff8VcFFcpdqUcPXQmAwwToer+sTMwqf0HJu/z9FkiA3u0TmLclyRN8Jiit1+vTATxr+Xg6DH0jLV4yAXCYAPvvlwXZgviLHSO7aNC/6Q09Ifl3nhynIAL0ThNYRDeSR3lD3yzA47GzjWhCdk8WvHgChEu7Xg4wHj8XMGKawNzS8qzBh+TGiPgCNM/PihclAJsNFNT26SggeTJodDWBmfAyau6eZ2cWBPDsRXa24YtZNXw8AfwJNaYHiD6/7rOBWhPYc00gW5IexjOguyePgLNNgDZeRxEUru1nIYDWBBanCQTorjCebVuHmZa7TWaVLluzwO1nECBAYNFLgAAkBwGy5zil0QTmWleQ+k1dPjL/LCbeVpQmMJkA+aTlZdAE5u5G0snB0dts2JXXPwOialZNYGvhiwQB8q8rUF4TWEQ3kkEUui3fSSCeIuc6QYUvcLA1HctfFkOAu/myc6vk3JNFJcprAovoRjJpAgF6jNqDvuEHPamXpEWPvOOPuHNvar08NwW3vgnnIfj3dBj6OUrGy9lC2F6tKFJeE1hENzLqy79KrQksohvRwS+xJrCIbkQHv8SawCK6EerPmzr4Qrx9tVrlAKU1gUV0IzTbflgHP4pn2PhR5fcJLERabpPzdPBFs45oh/L7BBbRjXgrdgKybR18A7p3VSqz2fYHKpsmkH2Ycta00aWGTfaOdPAhft6C6PJGY2lqRZ5PWc8OdhywAYD6cd7mU759wKw3jjXrzWPSW+NY9nsOS2k801w8nt2/PjtY463oAQHU1QRqvBKfHayDpWDwy6YJ1HglPjtYB0vB4JdNE6jxig1+6TSBquJVKps2WFYDUDMBQKcBgDfxxg7JGkTwh04TWNqzgwG5v8/+DacmUFW8atXZ2G1Fcp+DP5yaQFXxKpUt01kIMJJnBw8jmZggMy0BSnN2sLdVqlA0iR/siC3TCy6HCc+A6E9pCFCqs4P1/HsBeBwBSnd2sA5+AXgtApTy7GAd/ALwKAGUPTtYvIGjDn6ReGwH0Fag1oXO/M0b/ALODnbwyTpYvcUzbfdK7m1tByxvs8/jZT872CMBJNfrYPUID+CnanX7cK6vni4g4ZspAm//hy2CbOnsntXBLwbP3+YN74Zw8chW/7wmsZmWG+dPcVi58GI/bE9fttBwbq6xfm5uibPGevY9K3qktVHDsyxratOmU6a4sflUbIKWrshTCJ5sOXEVZytzOq/xFMGTnUhYydlkTuc1niJ4MhecCJvGGx48GbaNczam8cqP93/gvCQRfs3wvQAAAABJRU5ErkJggg==";
                        img.attr('src', thumbDataUrl);
                        img.attr('width', 150);
                        uploadBtn.attr('disabled', false);
                    });
                }

                fileInput.bind({
                    change: function() {
                        displayFiles(this.files);
                    }
                });

                uploadBtn.click(function(e) {
                    e.preventDefault();
                    fileList.find('li').each(function() {

                        var uploadItem = this;
                        var pBar = $(uploadItem).find('.progress');
                        var onprogress = function(percents) {
                                updateProgress(pBar, percents);
                            },
                            oncomplete = function() {
                                updateProgress(pBar, 100);
                                setTimeout(function(){
                                    fileInput.val('');
                                    fileList.html('');
                                    uploadBtn.attr('disabled', true);
                                    log('The sample data has bees successfully installed.');
                                }, 2000);

                            };

                        var uploader = new ChunkedUploader(uploadItem.file, {'progress' : onprogress, 'complete' : oncomplete});

                        uploader.upload();
                    });
                });
            });
        </script>
        <?php

        return ob_get_clean();

	}
}