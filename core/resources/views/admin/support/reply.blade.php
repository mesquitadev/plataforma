@extends('admin.layouts.app')

@section('panel')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body ">
                    <h6 class="card-title  mb-4">
                        <div class="row">
                            <div class="col-sm-8 col-md-6">
                                @if($ticket->status == 0)
                                    <span class="badge badge--success py-1 px-2">@lang('Aberto')</span>
                                @elseif($ticket->status == 1)
                                    <span class="badge badge--primary py-1 px-2">@lang('Respondido')</span>
                                @elseif($ticket->status == 2)
                                    <span class="badge badge--warning py-1 px-2">@lang('Resposta do Cliente')</span>
                                @elseif($ticket->status == 3)
                                    <span class="badge badge--dark py-1 px-2">@lang('Fechado')</span>
                                @endif
                                [@lang('Ticket#'){{ $ticket->ticket }}] {{ $ticket->subject }}
                            </div>
                            <div class="col-sm-4  col-md-6 text-sm-right mt-sm-0 mt-3">

                                <button class="btn btn--danger btn-sm" type="button" data-toggle="modal" data-target="#DelModal">
                                    <i class="fa fa-lg fa-times-circle"></i> @lang('Fechar Ticket')
                                </button>
                            </div>
                        </div>
                    </h6>

                    <form action="{{ route('admin.ticket.reply', $ticket->id) }}" enctype="multipart/form-data" method="post" class="form-horizontal">
                        @csrf
                        <div class="form-group">
                            <textarea class="form-control" name="message" rows="3" id="inputMessage" placeholder="@lang('Sua Mensagem')"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="inputAttachments">@lang('Anexos')</label>
                            <div class="file-upload-wrapper" data-text="@lang('Selecione os Arquivos!')">
                                <input type="file" name="attachments[]" id="inputAttachments"
                                class="file-upload-field"/>
                            </div>
                            <div id="fileUploadsContainer"></div>
                        </div>
                        <div class=" ticket-attachments-message text-muted mt-3">
                            @lang('Arquivos Permitidos'): .@lang('jpg'), .@lang('jpeg'), .@lang('png'), .@lang('pdf'), .@lang('doc'), .@lang('docx')
                        </div>

                        <button type="button" class="btn btn--dark add-more mt-2" ><i class="fa fa-plus"></i></button>


                        <button class="btn btn--primary btn-block mt-4" type="submit" name="replayTicket"
                                value="1"><i class="la la-fw la-lg la-reply"></i> @lang('Responder')
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body ">
                    @foreach($messages as $message)
                        @if($message->admin_id == 0)
                            <div class="row border border-primary border-radius-3 my-3 mx-2">
                                <div class="col-md-3 border-right text-right">
                                    <h5 class="my-3">{{ $ticket->name }}</h5>
                                    @if($ticket->user_id != null)
                                        <p><a href="{{route('admin.users.detail', $ticket->user_id)}}" >&#64;{{ $ticket->name }}</a></p>
                                    @else
                                        <p>@<span>{{$ticket->name}}</span></p>
                                    @endif
                                    <button data-id="{{$message->id}}" type="button" data-toggle="modal" data-target="#DelMessage" class="btn btn-danger btn-sm my-3 delete-message"><i class="la la-trash"></i> @lang('Delete')</button>
                                </div>

                                <div class="col-md-9">
                                    <p class="text-muted font-weight-bold my-3">
                                        @lang('Posted on') {{ showDateTime($message->created_at, 'l, dS F Y @ H:i') }}</p>
                                    <p>{{ $message->message }}</p>
                                    @if($message->attachments()->count() > 0)
                                        <div class="my-3">
                                            @foreach($message->attachments as $k=> $image)
                                                <a href="{{route('admin.ticket.download',encrypt($image->id))}}" class="mr-3"><i class="fa fa-file"></i>@lang('Anexo') {{++$k}}</a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <div class="row border border-warning border-radius-3 my-3 mx-2 admin-bg-reply">

                                <div class="col-md-3 border-right text-right">
                                    <h5 class="my-3">{{ @$message->admin->name }}</h5>
                                    <p class="lead text-muted">@lang('Funcionários')</p>
                                    <button data-id="{{$message->id}}" type="button" data-toggle="modal" data-target="#DelMessage" class="btn btn-danger btn-sm my-3 delete-message"><i class="la la-trash"></i> @lang('Delete')</button>
                                </div>

                                <div class="col-md-9">
                                    <p class="text-muted font-weight-bold my-3">
                                        @lang('Posted on') {{showDateTime($message->created_at,'l, dS F Y @ H:i') }}</p>
                                    <p>{{ $message->message }}</p>
                                    @if($message->attachments()->count() > 0)
                                        <div class="my-3">
                                            @foreach($message->attachments as $k=> $image)
                                                <a href="{{route('admin.ticket.download',encrypt($image->id))}}" class="mr-3"><i class="fa fa-file"></i>  @lang('Anexo') {{++$k}} </a>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>

                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"> @lang('Fechar Ticket!')</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>@lang('Voc6e deseja Fechar o Ticket?')</strong>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{ route('admin.ticket.reply', $ticket->id) }}">
                        @csrf

                        <button type="button" class="btn btn--secondary" data-dismiss="modal">@lang('Sim') </button>
                        <button type="submit" class="btn btn--success" name="replayTicket" value="2"> @lang('Fechar Ticket') </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="DelMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">@lang('Deletar Resposta!')</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <strong>@lang('Você deseja Deletar?')</strong>
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{ route('admin.ticket.delete')}}">
                        @csrf
                        <input type="hidden" name="message_id" class="message_id">
                        <button type="button" class="btn btn--dark" data-dismiss="modal">@lang('Não') </button>
                        <button type="submit" class="btn btn--danger"><i class="fa fa-trash"></i> @lang('Deletar') </button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection




@push('breadcrumb-plugins')
    <a href="{{ route('admin.ticket') }}" class="btn btn-sm btn--primary box--shadow1 text--small"><i class="la la-fw la-backward"></i> @lang('Voltar') </a>
@endpush

@push('script')
    <script>
        'use strict';
        (function($){
            $('.delete-message').on('click', function (e) {
                $('.message_id').val($(this).data('id'));
            });

            $('.add-more').on('click', function(){
                $("#fileUploadsContainer").append(`
                <div class="file-upload-wrapper" data-text="Select your file!"><input type="file" name="attachments[]" id="inputAttachments" class="file-upload-field"/></div>`)
            })
        })(jQuery)
    </script>
@endpush
