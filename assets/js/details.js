document.addEventListener('DOMContentLoaded', function () {
    
    // 1. Favorites Button Toggle Handler
    const favBtn = document.getElementById("favBtn");
    if (favBtn) {
        favBtn.addEventListener("click", function () {
            const icon = this.querySelector("i");
            if (icon.classList.contains("ri-heart-line")) {
                icon.classList.remove("ri-heart-line");
                icon.classList.add("ri-heart-fill");
                this.classList.add("active");
            } else {
                icon.classList.remove("ri-heart-fill");
                icon.classList.add("ri-heart-line");
                this.classList.remove("active");
            }
        });
    }

    // Calculator and Date Input Elements
    const checkInInput = document.getElementById('checkInDate');
    const checkOutInput = document.getElementById('checkOutDate');
    const tripDaysCount = document.getElementById('tripDaysCount');
    
    const adultMinus = document.getElementById('adultMinus');
    const adultPlus = document.getElementById('adultPlus');
    const adultCountSpan = document.getElementById('adultCount');

    const childMinus = document.getElementById('childMinus');
    const childPlus = document.getElementById('childPlus');
    const childCountSpan = document.getElementById('childCount');

    const transToggleBox = document.getElementById('transToggleBox');
    const guideToggleBox = document.getElementById('guideToggleBox');
    const transBreakdownItem = document.getElementById('transBreakdownItem');
    const guideBreakdownItem = document.getElementById('guideBreakdownItem');
    
    const entryCalcText = document.getElementById('entryCalcText');
    const entryTotalPrice = document.getElementById('entryTotalPrice');
    const transCalcText = document.getElementById('transCalcText');
    const transTotalPrice = document.getElementById('transTotalPrice');
    const guideCalcText = document.getElementById('guideCalcText');
    const guideTotalPrice = document.getElementById('guideTotalPrice');
    const grandTotalPrice = document.getElementById('grandTotalPrice');

    // Booking Summary Elements
    const summaryCheckIn = document.getElementById('summaryCheckIn');
    const summaryCheckOut = document.getElementById('summaryCheckOut');
    const summaryGuestsText = document.getElementById('summaryGuestsText');
    const summaryHotelName = document.getElementById('summaryHotelName');
    const summaryNightsCount = document.getElementById('summaryNightsCount');
    const summaryHotelPrice = document.getElementById('summaryHotelPrice');
    const summaryTotalPersonsCount = document.getElementById('summaryTotalPersonsCount');
    const summaryTicketPrice = document.getElementById('summaryTicketPrice');
    const summaryTransRow = document.getElementById('summaryTransRow');
    const summaryTransPrice = document.getElementById('summaryTransPrice');
    const summaryGuideRow = document.getElementById('summaryGuideRow');
    const summaryGuidePrice = document.getElementById('summaryGuidePrice');
    const summaryFinalTotalPrice = document.getElementById('summaryFinalTotalPrice');

    const ticketUnitPriceElement = document.getElementById('ticketUnitPrice');
    const ticketUnitPrice = ticketUnitPriceElement ? parseFloat(ticketUnitPriceElement.innerText) || 20 : 20;

    let adults = 1;
    let children = 0;
    let days = 2;
    let transSelected = false;
    let guideSelected = false;
    
    let selectedHotelPricePerNight = 0;
    let selectedHotelTitle = "None selected";

    // Format date string for summary view
    function formatDateStr(dateStr) {
        if (!dateStr) return "";
        const parts = dateStr.split('-');
        if (parts.length !== 3) return dateStr;
        
        const year = parts[0];
        const monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        const monthIndex = parseInt(parts[1], 10) - 1;
        const month = monthNames[monthIndex] || "";
        const day = parseInt(parts[2], 10);

        return `${day} ${month} ${year}`;
    }

    // Calculate total trip days based on check-in and check-out dates
    function calculateDays() {
        if (checkInInput && checkOutInput && checkInInput.value && checkOutInput.value) {
            const d1 = new Date(checkInInput.value);
            const d2 = new Date(checkOutInput.value);
            const diffTime = d2 - d1;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            days = diffDays > 0 ? diffDays : 1;
        } else {
            days = 1;
        }
        if (tripDaysCount) tripDaysCount.innerText = days + (days > 1 ? ' Days' : ' Day');
        if (summaryCheckIn && checkInInput) summaryCheckIn.innerText = formatDateStr(checkInInput.value);
        if (summaryCheckOut && checkOutInput) summaryCheckOut.innerText = formatDateStr(checkOutInput.value);
        if (summaryNightsCount) summaryNightsCount.innerText = days;
    }

    // Update all dynamic price calculations and summary elements
    function updateCalculations() {
        calculateDays();
        const totalPersons = adults + children;
        
        if (adultCountSpan) adultCountSpan.innerText = adults;
        if (childCountSpan) childCountSpan.innerText = children;
        if (summaryGuestsText) summaryGuestsText.innerText = `${adults} Adults, ${children} Children    `;
        if (summaryTotalPersonsCount) summaryTotalPersonsCount.innerText = totalPersons;

        const ticketTotal = ticketUnitPrice * totalPersons;
        if (entryCalcText) entryCalcText.innerText = `$${ticketUnitPrice} × ${totalPersons}`;
        if (entryTotalPrice) entryTotalPrice.innerText = `$${ticketTotal}`;
        if (summaryTicketPrice) summaryTicketPrice.innerText = `$${ticketTotal}`;

        let carsNeeded = Math.ceil(adults / 4);
        if (carsNeeded < 1) carsNeeded = 1;
        const carPricePerUnit = 40; 
        const transTotal = carsNeeded * carPricePerUnit;

        if (transSelected) {
            if (transBreakdownItem) transBreakdownItem.style.display = 'flex';
            if (transCalcText) transCalcText.innerText = `${carsNeeded} Car(s) x $${carPricePerUnit}`;
            if (transTotalPrice) transTotalPrice.innerText = `$${transTotal}`;
            if (summaryTransRow) summaryTransRow.style.display = 'flex';
            if (summaryTransPrice) summaryTransPrice.innerText = `$${transTotal}`;
        } else {
            if (transBreakdownItem) transBreakdownItem.style.display = 'none';
            if (summaryTransRow) summaryTransRow.style.display = 'none';
        }

        const guideFixedPrice = 10;
        if (guideSelected) {
            if (guideBreakdownItem) guideBreakdownItem.style.display = 'flex';
            if (guideCalcText) guideCalcText.innerText = `Fixed Price`;
            if (guideTotalPrice) guideTotalPrice.innerText = `$${guideFixedPrice}`;
            if (summaryGuideRow) summaryGuideRow.style.display = 'flex';
            if (summaryGuidePrice) summaryGuidePrice.innerText = `$${guideFixedPrice}`;
        } else {
            if (guideBreakdownItem) guideBreakdownItem.style.display = 'none';
            if (summaryGuideRow) summaryGuideRow.style.display = 'none';
        }

        const hotelTotal = selectedHotelPricePerNight * days;
        if (summaryHotelName) summaryHotelName.innerText = selectedHotelTitle;
        if (summaryHotelPrice) summaryHotelPrice.innerText = `$${hotelTotal}`;

        let grandTotal = ticketTotal + hotelTotal;
        if (transSelected) grandTotal += transTotal;
        if (guideSelected) grandTotal += guideFixedPrice;
        
        let fixedTaxes = 12;
        let finalGrandTotalWithTaxes = grandTotal + fixedTaxes;

        if (grandTotalPrice) grandTotalPrice.innerText = `$${grandTotal}`;
        if (summaryFinalTotalPrice) summaryFinalTotalPrice.innerText = `$${finalGrandTotalWithTaxes}`;
    }

    // Event listeners for guest counters increment/decrement buttons
    if (adultPlus) adultPlus.addEventListener('click', () => { adults++; updateCalculations(); });
    if (adultMinus) adultMinus.addEventListener('click', () => { if (adults > 1) adults--; updateCalculations(); });
    if (childPlus) childPlus.addEventListener('click', () => { children++; updateCalculations(); });
    if (childMinus) childMinus.addEventListener('click', () => { if (children > 0) children--; updateCalculations(); });

    // Event listeners for date inputs change
    if (checkInInput) checkInInput.addEventListener('change', updateCalculations);
    if (checkOutInput) checkOutInput.addEventListener('change', updateCalculations);

    // Toggle listener for transportation option
    if (transToggleBox) {
        transToggleBox.addEventListener('click', () => {
            transSelected = !transSelected;
            transToggleBox.classList.toggle('active', transSelected);
            const statusSpan = transToggleBox.querySelector('.toggle-status');
            const selectBtn = transToggleBox.querySelector('.calc-select-btn');
            if (statusSpan) statusSpan.textContent = transSelected ? "Included" : "Not Included";
            if (selectBtn) selectBtn.innerHTML = transSelected ? '<i class="ri-check-line"></i> Selected' : 'Select';
            updateCalculations();
        });
    }

    // Toggle listener for tour guide option
    if (guideToggleBox) {
        guideToggleBox.addEventListener('click', () => {
            guideSelected = !guideSelected;
            guideToggleBox.classList.toggle('active', guideSelected);
            const statusSpan = guideToggleBox.querySelector('.toggle-status');
            const selectBtn = guideToggleBox.querySelector('.calc-select-btn');
            if (statusSpan) statusSpan.textContent = guideSelected ? "Included" : "Not Included";
            if (selectBtn) selectBtn.innerHTML = guideSelected ? '<i class="ri-check-line"></i> Selected' : 'Select';
            updateCalculations();
        });
    }

    // Hotel cards selection management, border animation, and checkmark badge creation
    const hotelCards = document.querySelectorAll(".hotel-card");
    hotelCards.forEach(card => {
        const btn = card.querySelector(".select-btn");
        if (!btn) return;

        btn.addEventListener("click", function () {
            const isAlreadySelected = card.classList.contains("selected");

            // Reset all hotel cards selection state and remove badges
            hotelCards.forEach(c => {
                c.classList.remove("selected");
                const cBtn = c.querySelector(".select-btn");
                if (cBtn) cBtn.innerHTML = "Select";
                
                const existingBadge = c.querySelector(".hotel-check-badge");
                if (existingBadge) existingBadge.remove();
            });

            if (isAlreadySelected) {
                selectedHotelTitle = "None selected";
                selectedHotelPricePerNight = 0;
            } else {
                card.classList.add("selected");
                btn.innerHTML = '<i class="ri-check-line"></i> Selected';

                const hotelNameEl = card.querySelector(".hotel-name") || card.querySelector("h3") || card.querySelector("h4");
                const hotelPriceEl = card.querySelector(".hotel-price") || card.querySelector(".price");

                selectedHotelTitle = hotelNameEl ? hotelNameEl.textContent.trim() : "Selected Hotel";
                if (hotelPriceEl) {
                    const cleanPrice = hotelPriceEl.textContent.replace(/[^0-9.]/g, '');
                    selectedHotelPricePerNight = parseFloat(cleanPrice) || 0;
                } else {
                    selectedHotelPricePerNight = 0;
                }

                // Append animated checkmark badge to the hotel image container
                const imgContainer = card.querySelector('.hotel-img-container') || card.querySelector('img').parentElement;
                if (imgContainer && !imgContainer.querySelector('.hotel-check-badge')) {
                    imgContainer.style.position = 'relative';
                    const badge = document.createElement('div');
                    badge.className = 'hotel-check-badge';
                    badge.innerHTML = '<i class="ri-check-line"></i>';
                    imgContainer.appendChild(badge);
                }
            }
            updateCalculations();
        });
    });

    // Initial call to set up default calculations on load
    updateCalculations();
});