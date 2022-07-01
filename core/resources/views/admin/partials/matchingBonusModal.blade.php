{{--   modal----}}
<div class="modal fade bd-example-modal-lg" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@lang('Configuração de CRON para Pagamentos')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 my-2">
                        <p class="cron-p-style"> @lang('Para automatizar o BV Matching Bonus, escolha a configuração necessária acima e execute o')
                            <code> @lang('cron job') </code> @lang('em seu servidor. Defina o tempo Cron o mínimo possível. Uma vez por')
                            <code>@lang('5-15')</code> @lang('minutos é ideal')</p>
                    </div>
                    <div class="col-md-12">
                        <label>@lang('Comando CRON')</label>
                        <div class="input-group ">
                            <input id="ref" type="text" class="form-control form-control-lg"
                                   value="curl -s {{route('bv.matching.cron')}}"  readonly="">
                            <div class="input-group-append" id="copybtn">
                                <span class="input-group-text btn--success"
                                      title="" onclick="myFunction()" > @lang('Copiar')</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('Fechar')</button>
            </div>
        </div>
    </div>
</div>

@push('script')
    @if(Carbon\Carbon::parse($general->last_cron)->diffInSeconds()>=900)
        <script>
            'use strict';
            (function($){
                $("#myModal").modal('show');
            })(jQuery)

            function myFunction() {
                var copyText = document.getElementById("ref");
                copyText.select();
                copyText.setSelectionRange(0, 99999)
                document.execCommand("copy");
                notify('success', 'URL Copiada com sucesso ' + copyText.value);
            }
        </script>
    @endif
@endpush

