@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
    @if(session('mensagem_status_aviso'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>{{ session('mensagem_status_aviso') }}</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('mensagem_status'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
            <strong>{{ session('mensagem_status') }}</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if(session('mensagem_status_erro'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>{{ session('mensagem_status_erro') }}</strong> <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    @if($compra->cpf_cliente)
                        <h5 class="card-title">{{ __('CPF') }}: {{ $compra->cpf_cliente }}</h5>
                    @endif
                    <h5 class="card-title">{{ __('Total') }}: R$ {{ $compra->total }}</h5>
                    <h5 class="card-title">{{ __('Dia') }}: {{ $compra->data_compra }}</h5>
                </div>

                <div class="card-body">
                    <div class="row justify-content-center">
                        @forelse($itens_carrinho as $item)
                            <div class="col-md-10 mb-2">
                                <div class="card-header">
                                    <b>{{ $item->nome }} - (R$ {{ $item->preco_venda }}) => (R$ {{ $item->preco_atual }})</b>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="preco_total">Quantidade</label>
                                                <input type="number" class="form-control mb-2" min="0" step="1" id="quantidade" name="quantidade" value="{{ $item->quantidade }}" disabled>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="preco_total">Desconto</label>
                                                <input type="text" class="form-control mb-2" value="R$ {{ ($item->preco_total - $item->preco_com_desconto) }}" disabled>
                                            </div>

                                            <div class="col-md-3">
                                                <label for="preco_total">Preço total</label>
                                                <input type="text" class="form-control mb-2" value="R$ {{ $item->preco_com_desconto }}" disabled>
                                            </div>

                                            <div class="col-md-3">
                                                <label for=""></label>
                                                <a class="btn btn-info col-12" href="{{ route('visualizarProduto', ['produto' => $item->produto_id]) }}" role="button">{{ __('Visualizar') }}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col">
                                <h4 style="text-align: center; color:gray">Carrinho vazio</h4>
                            </div>
                        @endforelse
                        <a class="btn btn-danger col-md-12 mt-1" href="{{ route('telaHistoricoCompras') }}">
                            {{ __('Voltar') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
