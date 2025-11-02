function switchView(view){
    const container = document.querySelector('.artwork-container');
    const gridBtn = document.querySelector('.grid-view');
    const listBtn = document.querySelector('.list-view');
    if (view === 'grid') {
        container.classList.remove('list-layout');
        container.classList.add('grid-layout');

        gridBtn.classList.add('active');
        listBtn.classList.remove('active');
    } else {
        container.classList.remove('grid-layout');
        container.classList.add('list-layout');

        gridBtn.classList.remove('active');
        listBtn.classList.add('active');
    }
}