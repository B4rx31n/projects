// script.js
let allData = [];
let displayed = 0;
const PAGE_SIZE = 12;

function createCard(anime) {
  const div = document.createElement('div');
  div.className = "bg-[#111] rounded-lg overflow-hidden shadow-lg";
  div.innerHTML = `
    <img class="card-img" src="${anime.image}" alt="${anime.title}">
    <div class="p-4">
      <h3 class="text-white text-lg font-semibold mb-1">${anime.title}</h3>
      <p class="text-sm text-gray-400 mb-1">Episodes: <span class="text-gray-200">${anime.episodes}</span></p>
      <p class="text-sm text-gray-400 mb-3">Rating: <span class="text-yellow-400">⭐ ${anime.rating}</span></p>
      <div class="flex space-x-2">
        <a href="${anime.link}" target="_blank" class="inline-block px-3 py-1 border border-[#ff9f00] text-[#ff9f00] rounded hover:bg-[#ff9f00] hover:text-black transition">WATCH NOW</a>
        <button data-title="${anime.title}" class="info-btn px-3 py-1 border border-gray-600 text-sm rounded text-gray-300">DETAILS</button>
      </div>
    </div>
  `;
  // details popup (simple)
  div.querySelector('.info-btn').addEventListener('click', (e)=>{
    alert(`${anime.title}\nEpisodes: ${anime.episodes}\nRating: ${anime.rating}\nLink: ${anime.link}`);
  });
  return div;
}

function renderMore() {
  const grid = document.getElementById('anime-grid');
  const slice = allData.slice(displayed, displayed + PAGE_SIZE);
  slice.forEach(a => grid.appendChild(createCard(a)));
  displayed += slice.length;
  if (displayed >= allData.length) document.getElementById('load-more').disabled = true;
}

function resetRender(filtered){
  const grid = document.getElementById('anime-grid');
  grid.innerHTML = '';
  displayed = 0;
  allData = filtered;
  document.getElementById('load-more').disabled = false;
  renderMore();
}

document.addEventListener('DOMContentLoaded', ()=>{
  fetch('anime-data.json')
    .then(r => r.json())
    .then(data => {
      allData = data;
      resetRender(allData);
    })
    .catch(err => {
      console.error('Failed to load anime-data.json', err);
      document.getElementById('anime-grid').innerHTML = `<p class="text-red-400">Failed to load data. Check the console.</p>`;
    });

  document.getElementById('load-more').addEventListener('click', renderMore);

  // search
  const search = document.getElementById('search');
  const searchBtn = document.getElementById('search-btn');
  function doSearch(){
    const q = search.value.trim().toLowerCase();
    if (!q) return resetRender(JSON.parse(JSON.stringify(allData)));
    const filtered = allData.filter(a => a.title.toLowerCase().includes(q));
    resetRender(filtered);
  }
  search.addEventListener('keypress', (e)=>{ if (e.key === 'Enter') doSearch(); });
  searchBtn.addEventListener('click', doSearch);

  // random watch
  document.getElementById('btn-random').addEventListener('click', ()=>{
    if (!allData.length) return;
    const idx = Math.floor(Math.random() * allData.length);
    const url = allData[idx].link;
    window.open(url, '_blank');
  });

  document.getElementById('btn-reset').addEventListener('click', ()=>{
    // reload full json and render
    fetch('anime-data.json').then(r=>r.json()).then(data=>{
      resetRender(data);
      document.getElementById('search').value = '';
    });
  });
});
