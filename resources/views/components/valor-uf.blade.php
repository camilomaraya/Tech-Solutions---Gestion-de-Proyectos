<div class="tarjeta-uf">
    <span class="tarjeta-uf__titulo">{{ $titulo }}</span>
    <strong class="tarjeta-uf__valor">
        ${{ number_format($uf['valor'], 2, ',', '.') }}
    </strong>
    <small class="tarjeta-uf__origen">
        Fuente: {{ $uf['origen'] }} &middot;
        {{ \Carbon\Carbon::parse($uf['fecha'])->format('d/m/Y') }}
    </small>
</div>
