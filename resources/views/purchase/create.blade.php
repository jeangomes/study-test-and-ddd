<h1>Cadastro de Purchase</h1>
<form action="{{ route('purchase.store') }}" method="post">
    @csrf
    <label>Store</label>
    <input type="text" name="store" value="Sacolão (Rede Qualy)">

    <label>Data</label>
    <input type="datetime-local" name="purchased_at">

    <label>Valor</label>
    <input type="number" name="amount" step="0.01">

    <label>Imposto</label>
    <input type="number" name="tax" step="0.01">

    <label>Chave nfce</label>
    <input type="text" name="nfce_key_access" id="nfce_key_access">
    <br><br>
    <textarea
        name="content"
        rows="20"
        cols="90"
        placeholder="Comment text."></textarea>

    <input type="submit" value="Salvar">
</form>
