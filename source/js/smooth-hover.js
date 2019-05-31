
const triggers = document.querySelectorAll('.tags div');
const highlight = document.createElement('span');
highlight.classList.add('taghover');
document.body.append(highlight);

function highlightLink() {
const linkCoords = this.getBoundingClientRect();

const coords = {
  width: linkCoords.width,
  height: linkCoords.height,
  top: linkCoords.top + window.scrollY,
  left: linkCoords.left + window.scrollX
};

highlight.style.width = `${coords.width}px`;
highlight.style.height = `${coords.height}px`;
highlight.style.transform = `translate(${coords.left}px, ${coords.top}px)`;
}

triggers.forEach(a => a.addEventListener('mouseenter', highlightLink));

triggers.forEach(a => a.addEventListener('focus', highlightLink));
