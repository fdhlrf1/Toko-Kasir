const toggleButton = document.querySelector('.toggle-sidebar');
const sidebar = document.getElementById('sidebar');
const content = document.getElementById('content');

toggleButton.addEventListener('click', function () {
    sidebar.classList.toggle('active');
    content.classList.toggle('active');
});