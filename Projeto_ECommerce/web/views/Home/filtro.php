<?php
// filtro.php – agora seguindo o estilo EXATO do home.css
?>

<style>
/* ============================
   🎨 ESTILO DO FILTRO LATERAL
=============================== */
.sidebar-box {
    background: #2f2f2f; /* Mesmo fundo da navbar */
    padding: 20px;
    border-radius: 12px;
    color: white;
    font-family: 'Inter', sans-serif;
}

/* Cabeçalho do grupo */
.filter-header {
    background: #1a1a1a; 
    padding: 10px 12px;
    border-radius: 8px;
    margin-bottom: 6px;
    cursor: pointer;
    font-weight: 600;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: 0.2s;

}

.filter-header:hover {
    background: #222;
}

/* Conteúdo interno */
.filter-content {
    background: #1a1a1a;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 15px;

}

/* Checkbox */
.checkbox-item {
    display: flex;
    justify-content: space-between;
    font-size: 0.9rem;
    padding: 4px 0;
}

.checkbox-item input {
    margin-right: 6px;
}

.checkbox-item span {
    color: #777;
}

/* Sliders */
.range {
    width: 100%;
    margin-bottom: 8px;

}

/* Select */
select.form-select {
    background: #1a1a1a;
    color: white;
    border: 1px solid #333;
}

/* Botões */
.btn-filter {
    width: 50%;
    border-radius: 6px;
    padding: 8px;
    font-weight: 600;

}

.btn-clear {
    background: #3a3a3a;
    color: white;
    border: 1px solid #555;
}

.btn-clear:hover {
    background: #4b4b4b;
}

.btn-apply {
    background: #007bff;
    color: white;
    border: none;
}

.btn-apply:hover {
    background: #0069d9;
}
/* ===== RANGE SLIDER CUSTOM ===== */

/* Estilo geral da barra */
.range {
    -webkit-appearance: none;
    height: 6px;
    background: #444;
    border-radius: 6px;
    outline: none;
}

/* Chrome, Edge, Safari — botão (thumb) azul */
.range::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 18px;
    height: 18px;
    background: #007bff; /* 🔵 azul */
    border-radius: 50%;
    cursor: pointer;
}

/* Firefox */
.range::-moz-range-thumb {
    width: 18px;
    height: 18px;
    background: #007bff; /* 🔵 azul */
    border-radius: 50%;
    cursor: pointer;
}

/* Barra preenchida no Firefox */
.range::-moz-range-progress {
    background: #005fcc;
}

/* Para o resto da barra */
.range::-webkit-slider-runnable-track {
    background: #444;
    border-radius: 6px;
}
/* Input da busca do filtro */
.search-filter {
    background: #1a1a1a !important; /* um pouco mais claro */
    border: 1px solid #333 !important;
    color: #fff !important;
    height: 40px;
    padding-left: 12px;
    border-radius: 8px;
}

/* Placeholder mais claro */
.search-filter::placeholder {
    color: #cccccc; /* cinza claro */
}
/* Checkbox customizado */
.checkbox-item input[type="checkbox"] {
    appearance: none;
    width: 18px;
    height: 18px;
    border: 2px solid #777;
    border-radius: 4px;
    background: #1a1a1a;
    cursor: pointer;
    transition: 0.2s;
    position: relative;
}

/* Hover */
.checkbox-item input[type="checkbox"]:hover {
    border-color: #aaa;
}

/* Quando marcado – fundo azul + check */
.checkbox-item input[type="checkbox"]:checked {
    background-color: #007bff;
    border-color: #007bff;
}

/* Ícone de check */
.checkbox-item input[type="checkbox"]:checked::after {
    content: "✔";
    position: absolute;
    color: white;
    font-size: 12px;
    left: 3px;
    top: -1px;
}
</style>


<div class="sidebar-box">

    <form method="GET" action="busca.php" id="formFiltros">

        <!-- BUSCAR DENTRO DOS RESULTADOS -->
        <div class="mb-3">
            <input type="text" name="q" class="form-control search-filter"
                   style="background:#1a1a1a; border:1px solid #333; color:white; height:40px;"
                   placeholder="Buscar nos resultados..."
                   value="<?= htmlspecialchars($termoBusca) ?>">
        </div>

        <!-- PREÇO -->
        <div class="filter-group">
            <div class="filter-header" onclick="toggleFilter(this)">
                <span>Preço</span>
                <i class="bi bi-chevron-down"></i>
            </div>

            <div class="filter-content">
                <input type="range" id="minRange" min="0" max="5000" step="50"
                       value="<?= $precoMin ?>" class="range">
                <input type="range" id="maxRange" min="0" max="5000" step="50"
                       value="<?= $precoMax ?>" class="range">

                <input type="hidden" name="preco_min" id="hiddenPrecoMin" value="<?= $precoMin ?>">
                <input type="hidden" name="preco_max" id="hiddenPrecoMax" value="<?= $precoMax ?>">

                <div class="d-flex justify-content-between mt-2 small">
                    <span id="minLabel">R$ <?= $precoMin ?></span>
                    <span id="maxLabel">R$ <?= $precoMax ?></span>
                </div>
            </div>
        </div>

        <!-- CATEGORIA -->
        <div class="filter-group">
            <div class="filter-header" onclick="toggleFilter(this)">
                <span>Categoria</span>
                <i class="bi bi-chevron-down"></i>
            </div>

            <div class="filter-content">
                <?php foreach ($categorias as $cat): ?>
                    <label class="checkbox-item">
                        <span>
                            <input type="checkbox" name="categoria[]"
                                   value="<?= $cat['id'] ?>"
                                   <?= in_array($cat['id'], $categoria) ? 'checked' : '' ?>>
                            <?= $cat['nome'] ?>
                        </span>
                        <span>(<?= $cat['total'] ?>)</span>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- ORDENAÇÃO -->
        <div class="mt-3">
            <label class="mb-1">Ordenar por:</label>
            <select name="ordem" class="form-select">
                <option value="">Mais recentes</option>
                <option value="preco_asc"  <?= $ordem=='preco_asc'?'selected':'' ?>>Menor preço</option>
                <option value="preco_desc" <?= $ordem=='preco_desc'?'selected':'' ?>>Maior preço</option>
            </select>
        </div>

        <!-- BOTÕES -->
        <div class="d-flex gap-2 mt-4">
            <a href="busca.php" class="btn btn-clear btn-filter">Limpar</a>
            <button class="btn btn-apply btn-filter">Aplicar</button>
        </div>

    </form>
</div>

<script>
// EXPANDIR / FECHAR GRUPOS
function toggleFilter(el) {
    const content = el.nextElementSibling;
    content.style.display = (content.style.display === "none") ? "block" : "none";
}

// SLIDERS DE PREÇO
const minRange = document.getElementById("minRange");
const maxRange = document.getElementById("maxRange");
const minLabel = document.getElementById("minLabel");
const maxLabel = document.getElementById("maxLabel");
const hiddenPrecoMin = document.getElementById("hiddenPrecoMin");
const hiddenPrecoMax = document.getElementById("hiddenPrecoMax");

function atualizarValores() {
    let minV = parseInt(minRange.value);
    let maxV = parseInt(maxRange.value);
    if (minV >= maxV) minV = maxV - 50;

    minRange.value = minV;
    maxRange.value = maxV;

    hiddenPrecoMin.value = minV;
    hiddenPrecoMax.value = maxV;

    minLabel.textContent = "R$ " + minV;
    maxLabel.textContent = "R$ " + maxV;
}

minRange.addEventListener("input", atualizarValores);
maxRange.addEventListener("input", atualizarValores);
</script>
