@extends('admin.layouts.app')

@section('panel')
    <div class="row mb-none-30">
        <div class="col-xl-12">
            <div class="card">
                <form action="{{ route('admin.users.email.single', $user->id) }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <label class="font-weight-bold">@lang('Assunto') <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" placeholder="@lang('Assunto')" name="subject"  required/>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="font-weight-bold">@lang('Mensagem') <span class="text-danger">*</span></label>
                                <textarea name="message" rows="10" class="form-control nicEdit" placeholder="@lang('Sua Mensagem')"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="form-row">
                            <div class="form-group col-md-12 text-center">
                                <button type="submit" class="btn btn-block btn--primary mr-2">@lang('Enviar Email')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
