

//* ===================== TEMPLATES ===================== */
const filterTemplate = `
  <h5>Filtros</h5>

  <div class="mb-3">
    <label class="form-label fw-semibold">Buscar</label>
    <input class="form-control searchInput" type="text" placeholder="Pesquisar produto..." aria-label="Buscar produtos">
  </div>

  <div class="mb-3">
    <label class="form-label fw-semibold d-block">Preço (R$)</label>
    <div class="d-flex gap-2 align-items-center">
      <input type="range" class="form-range minPrice" min="0" max="5000" value="0" />
      <input type="range" class="form-range maxPrice" min="0" max="5000" value="5000" />
    </div>
    <div class="d-flex justify-content-between mt-2 counts">
      <span class="minValue">Min: R$ 0</span>
      <span class="maxValue">Max: R$ 5000</span>
    </div>
  </div>

  <hr>

  <div class="mb-2">
    <label class="form-label fw-semibold">Categoria</label>
    <div id="categoryList">
      <div class="form-check mb-1"><input class="form-check-input category" type="checkbox" value="ssd" id="cat-ssd"> <label class="form-check-label" for="cat-ssd">SSD <span class="counts">(<span class="count" data-category="ssd">0</span>)</span></label></div>
      <div class="form-check mb-1"><input class="form-check-input category" type="checkbox" value="placa-mae" id="cat-pm"> <label class="form-check-label" for="cat-pm">Placa-mãe <span class="counts">(<span class="count" data-category="placa-mae">0</span>)</span></label></div>
      <div class="form-check mb-1"><input class="form-check-input category" type="checkbox" value="ram" id="cat-ram"> <label class="form-check-label" for="cat-ram">Memória RAM <span class="counts">(<span class="count" data-category="ram">0</span>)</span></label></div>
      <div class="form-check mb-1"><input class="form-check-input category" type="checkbox" value="cpu" id="cat-cpu"> <label class="form-check-label" for="cat-cpu">Processador <span class="counts">(<span class="count" data-category="cpu">0</span>)</span></label></div>
      <div class="form-check mb-1"><input class="form-check-input category" type="checkbox" value="fonte" id="cat-fonte"> <label class="form-check-label" for="cat-fonte">Fonte <span class="counts">(<span class="count" data-category="fonte">0</span>)</span></label></div>
      <div class="form-check mb-1"><input class="form-check-input category" type="checkbox" value="gpu" id="cat-gpu"> <label class="form-check-label" for="cat-gpu">Placa de Vídeo <span class="counts">(<span class="count" data-category="gpu">0</span>)</span></label></div>
      <div class="form-check mb-1"><input class="form-check-input category" type="checkbox" value="gabinete" id="cat-gab"> <label class="form-check-label" for="cat-gab">Gabinete <span class="counts">(<span class="count" data-category="gabinete">0</span>)</span></label></div>
    </div>
  </div>

  <div class="d-flex gap-2">
    <button class="btn btn-outline-light clear-filters-btn w-100">Limpar</button>
    <button class="btn" id="applyFiltersBtn" style="background:var(--accent); color:#071025">Aplicar</button>
  </div>
`;

/* ===================== MOUNT FILTERS ===================== */
document.getElementById('desktopFilters').innerHTML = filterTemplate;
document.getElementById('mobileFilters').innerHTML = filterTemplate;

/* ===================== ELEMENTS ===================== */
const products = document.querySelectorAll('.product');
const searchInputs = document.querySelectorAll('.searchInput');
const minPriceInputs = document.querySelectorAll('.minPrice');
const maxPriceInputs = document.querySelectorAll('.maxPrice');
const minValueSpans = document.querySelectorAll('.minValue');
const maxValueSpans = document.querySelectorAll('.maxValue');
const categoryInputs = document.querySelectorAll('.category');
const clearButtons = document.querySelectorAll('.clear-filters-btn');
const applyButtons = document.querySelectorAll('#applyFiltersBtn');
const visibleCount = document.getElementById('visibleCount');
const noProductsPlaceholder = document.getElementById('noProductsPlaceholder');
const sortSelect = document.getElementById('sortSelect');

/* ===================== UPDATE CATEGORY COUNTS ===================== */
function updateCategoryCounts(){
  document.querySelectorAll('.count').forEach(span=>{
    const cat = span.dataset.category;
    const count = [...products].filter(p => p.dataset.category === cat).length;
    span.textContent = count;
  });
}

/* ===================== FILTER LOGIC ===================== */
function getFilterState(){
  const search = (searchInputs[0].value || '').trim().toLowerCase();
  const min = parseInt(minPriceInputs[0].value || 0, 10) || 0;
  const max = parseInt(maxPriceInputs[0].value || 5000, 10) || 5000;
  const activeCategories = [...categoryInputs].filter(c => c.checked).map(c => c.value);
  return { search, min, max, activeCategories };
}

function filterProducts(){
  const {search, min, max, activeCategories} = getFilterState();
  let anyVisible = false;

  products.forEach(p=>{
    const name = (p.dataset.name || '').toLowerCase();
    const price = parseInt(p.dataset.price || 0, 10);
    const cat = p.dataset.category || '';

    const matchName = name.includes(search);
    const matchPrice = price >= min && price <= max;
    const matchCat = activeCategories.length === 0 || activeCategories.includes(cat);

    const show = matchName && matchPrice && matchCat;
    p.style.display = show ? 'block' : 'none';
    if(show) anyVisible = true;
  });

  // atualiza contador e placeholder
  const visible = [...products].filter(p => p.style.display !== 'none').length;
  visibleCount.textContent = visible;

  if(!anyVisible){
    if(!document.getElementById('noProducts')){
      const div = document.createElement('div');
      div.id = 'noProducts';
      div.className = 'no-products';
      div.textContent = 'Nenhum produto encontrado.';
      noProductsPlaceholder.appendChild(div);
    }
  } else {
    const el = document.getElementById('noProducts');
    if(el) el.remove();
  }
}

/* ===================== SYNC HELPERS ===================== */
function syncValues(inputs, value){
  inputs.forEach(i => i.value = value);
}
function syncCheckboxes(changed){
  categoryInputs.forEach(cb=>{
    if(cb.value === changed.value && cb !== changed) cb.checked = changed.checked;
  });
}

/* ===================== EVENTS ===================== */
// Search inputs live update
searchInputs.forEach(input=>{
  input.addEventListener('input', e=>{
    syncValues(searchInputs, e.target.value);
    filterProducts();
  });
});

// Range inputs sync and update labels
minPriceInputs.forEach(input=>{
  input.addEventListener('input', e=>{
    syncValues(minPriceInputs, e.target.value);
    minValueSpans.forEach(s => s.textContent = 'Min: R$ ' + e.target.value);
    filterProducts();
  });
});
maxPriceInputs.forEach(input=>{
  input.addEventListener('input', e=>{
    syncValues(maxPriceInputs, e.target.value);
    maxValueSpans.forEach(s => s.textContent = 'Max: R$ ' + e.target.value);
    filterProducts();
  });
});

// category checkboxes
categoryInputs.forEach(cb=>{
  cb.addEventListener('change', e=>{
    syncCheckboxes(e.target);
    filterProducts();
  });
});

// clear filters
clearButtons.forEach(btn=>{
  btn.addEventListener('click', ()=>{
    searchInputs.forEach(i => i.value = '');
    minPriceInputs.forEach(i => i.value = i.min);
    maxPriceInputs.forEach(i => i.value = i.max);
    minValueSpans.forEach(s => s.textContent = 'Min: R$ ' + minPriceInputs[0].value);
    maxValueSpans.forEach(s => s.textContent = 'Max: R$ ' + maxPriceInputs[0].value);
    categoryInputs.forEach(cb => cb.checked = false);
    filterProducts();
  });
});

// apply buttons in filters (desktop + mobile)
applyButtons.forEach(b => b.addEventListener('click', () => {
  // close mobile offcanvas if open
  const off = document.querySelector('.offcanvas.show');
  if(off){
    const offInstance = bootstrap.Offcanvas.getInstance(off);
    if(offInstance) offInstance.hide();
  }
  filterProducts();
}));

// navbar search btn syncs to filters
document.getElementById('navbarSearchBtn').addEventListener('click', () => {
  const val = document.getElementById('navbarSearchInput').value;
  syncValues(searchInputs, val);
  filterProducts();
});

/* ===================== SORTING (client-side simple) ===================== */
sortSelect.addEventListener('change', () => {
  const val = sortSelect.value;
  const container = document.getElementById('productList');

  // get visible product nodes
  const nodes = Array.from(container.querySelectorAll('.product'));
  // sort function
  nodes.sort((a,b)=>{
    const pa = parseInt(a.dataset.price||0,10);
    const pb = parseInt(b.dataset.price||0,10);
    const na = (a.dataset.name||'').toLowerCase();
    const nb = (b.dataset.name||'').toLowerCase();

    if(val === 'price-asc') return pa - pb;
    if(val === 'price-desc') return pb - pa;
    if(val === 'name-asc') return na.localeCompare(nb);
    return 0; // default (relevance) keeps DOM order
  });

  // append sorted nodes
  nodes.forEach(n => container.appendChild(n));
});

/* ===================== INIT ===================== */
updateCategoryCounts();
filterProducts();
