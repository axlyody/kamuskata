@extends('layouts.app')
@section('title','Penerjemah Tampan')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form class="form-horizontal">
                    <div class="form-group">
                        <div class="col-xs-7 col-md-8">
                            <select class="selectpicker" data-live-search="true" id="dari">
                                @foreach($bahasa->orderBy('slug','asc')->get() as $bahasa1)
                                    <option name="slug" value="{{ $bahasa1->slug }}">{{ $bahasa1->bahasa }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-5 col-md-4" style="text-align:right">
                            <a href="#tukar" class="btn btn-warning"><i class="fa fa-refresh"></i></a>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-12">
                            <textarea id="kata_awal" class="form-control" rows="3"
                                      onkeypress="return delayExecute();"></textarea>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-md-6">
                <form class="form-horizontal">
                    <div class="form-group">
                        <div class="col-xs-7 col-md-8">
                            <select class="selectpicker" data-live-search="true" id="ke">

                                @foreach($bahasa->orderBy('slug','desc')->get() as $bahasa2)
                                    <option name="slug2" value="{{ $bahasa2->slug }}">{{ $bahasa2->bahasa }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-5 col-md-4" style="text-align:right;">
                            <a class="btn btn-success" onclick="terjemah(this)">Terjemahkan</a>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-12">
                            <textarea class="form-control" rows="3" id="artinya" disabled></textarea>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="result" style="color:red"></div>
    <script>

        var typingTimer;
        var doneTypingInterval = 700;

        function delayExecute() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(
                function () {
                    terjemah(this)
                },
                doneTypingInterval
            );

            return true;
        }


        function terjemah(val) {

            var kata_awal = $("#kata_awal").val();
            var dari = $("#dari").val();
            var ke = $("#ke").val();
            $("#artinya").val("Menerjemahkan...");
            var getJSON = function (url) {
                return new Promise(function (resolve, reject) {
                    var xhr = new XMLHttpRequest();
                    xhr.open('get', url, true);
                    xhr.responseType = 'json';
                    xhr.onload = function () {
                        var status = xhr.status;
                        if (status == 200) {
                            resolve(xhr.response);
                        } else {
                            reject(status);
                        }
                    };
                    xhr.send();
                });
            };

            getJSON('{{ url('/') }}/api/v1/terjemah?kata=' + kata_awal + '&dari=' + dari + '&ke=' + ke + '').then(function (data) {
                $("#artinya").val(data.arti);
                //display the result in an HTML element
            }, function (status) { //error detection....
                alert('Something went wrong.');
            })
        }
        var saveclass = null;

        function saveTheme(cookieValue) {
            var sel = document.getElementById('ThemeSelect');

            saveclass = saveclass ? saveclass : document.body.className;
            document.body.className = saveclass + ' ' + sel.options[sel.value].innerHTML.replace(" ", "").toLowerCase();

            setCookie('theme', cookieValue, 365);
        }

        function setCookie(cookieName, cookieValue, nDays) {
            var today = new Date();
            var expire = new Date();

            if (nDays == null || nDays == 0)
                nDays = 1;

            expire.setTime(today.getTime() + 3600000 * 24 * nDays);
            document.cookie = cookieName + "=" + escape(cookieValue) + ";expires=" + expire.toGMTString();
        }
    </script>
@endsection
