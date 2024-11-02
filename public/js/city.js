document.addEventListener('DOMContentLoaded', function () {
    const tooltip = document.createElement('div');
    tooltip.id = 'tooltip';
    tooltip.style.position = 'absolute';
    tooltip.style.backgroundColor = '#333';
    tooltip.style.color = '#fff';
    tooltip.style.padding = '8px 12px';
    tooltip.style.borderRadius = '5px';
    tooltip.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.3)';
    tooltip.style.display = 'none';
    tooltip.style.zIndex = '1000';
    document.body.appendChild(tooltip);

    document.querySelectorAll('[data-description]').forEach(function (element) {
        element.addEventListener('mouseenter', function (event) {
            tooltip.innerText = element.getAttribute('data-description');
            tooltip.style.display = 'block';
        });

        element.addEventListener('mousemove', function (event) {
            tooltip.style.left = event.pageX + 15 + 'px';
            tooltip.style.top = event.pageY + 15 + 'px';
        });

        element.addEventListener('mouseleave', function () {
            tooltip.style.display = 'none';
        });
    });
});