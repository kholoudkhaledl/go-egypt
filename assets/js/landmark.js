async function fetchDestinations() {
    const selectedCategory = document.querySelector('input[name="category"]:checked').value;
    const selectedRegion   = document.querySelector('input[name="region"]:checked').value;

    const response = await fetch(`../action/get_destination.php?category=${encodeURIComponent(selectedCategory)}&region=${encodeURIComponent(selectedRegion)}`);
    const htmlData = await response.text();
    document.getElementById('cards-container').innerHTML = htmlData;
}

fetchDestinations();

