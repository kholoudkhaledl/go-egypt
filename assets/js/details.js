/* =========================================================================
   details.js
   Handles all interactivity on pages/details.php:
     - Favorite (heart) button toggle
     - Hotel selection cards
     - Check-in / Check-out date pickers (drives number of nights + hotel price)
     - Adults / Children counters
     - Transportation & Tour Guide toggles
       -> Transportation automatically splits guests into multiple cars
          when the group is too big for a single car, and adjusts price
     - Trip Cost Calculator + Booking Summary sidebar (kept in sync live)
     - Hidden form fields sent to checkout.php on "Proceed to Payment"
   ========================================================================= */

document.addEventListener("DOMContentLoaded", function () {

    /* ---------------------------------------------------------------
       Favorite (heart) button
       --------------------------------------------------------------- */
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

    /* ---------------------------------------------------------------
       Element references
       --------------------------------------------------------------- */
    // Guests
    const adultMinus = document.getElementById("adultMinus");
    const adultPlus = document.getElementById("adultPlus");
    const adultCountSpan = document.getElementById("adultCount");

    const childMinus = document.getElementById("childMinus");
    const childPlus = document.getElementById("childPlus");
    const childCountSpan = document.getElementById("childCount");

    // Dates
    const checkInInput = document.getElementById("checkInDate");
    const checkOutInput = document.getElementById("checkOutDate");
    const nightsBadge = document.getElementById("nightsBadge");
    const dateErrorText = document.getElementById("dateErrorText");

    // Transportation / Tour guide toggles
    const transToggleBox = document.getElementById("transToggleBox");
    const guideToggleBox = document.getElementById("guideToggleBox");

    // Cost calculator breakdown
    const entryCalcText = document.getElementById("entryCalcText");
    const entryTotalPrice = document.getElementById("entryTotalPrice");

    const nightsCountText = document.getElementById("nightsCountText");
    const hotelBreakdownItem = document.getElementById("hotelBreakdownItem");
    const hotelCalcText = document.getElementById("hotelCalcText");
    const hotelTotalPrice = document.getElementById("hotelTotalPrice");

    const transBreakdownItem = document.getElementById("transBreakdownItem");
    const transCalcText = document.getElementById("transCalcText");
    const transTotalPrice = document.getElementById("transTotalPrice");

    const guideBreakdownItem = document.getElementById("guideBreakdownItem");
    const guideCalcText = document.getElementById("guideCalcText");
    const guideTotalPrice = document.getElementById("guideTotalPrice");

    const grandTotalPrice = document.getElementById("grandTotalPrice");
    const summaryTotalPrice = document.getElementById("summaryTotalPrice");

    // Booking summary sidebar
    const summaryGuests = document.getElementById("summaryGuests");
    const summaryCheckin = document.getElementById("summaryCheckin");
    const summaryCheckout = document.getElementById("summaryCheckout");
    const summaryNights = document.getElementById("summaryNights");
    const summaryEntryCount = document.getElementById("summaryEntryCount");
    const summaryEntryPrice = document.getElementById("summaryEntryPrice");
    const summaryHotelName = document.getElementById("summaryHotelName");
    const summaryHotelPrice = document.getElementById("summaryHotelPrice");
    const summaryTransPrice = document.getElementById("summaryTransPrice");
    const summaryGuidePrice = document.getElementById("summaryGuidePrice");

    // Hidden inputs submitted to checkout.php
    const hiddenAdults = document.getElementById("hiddenAdults");
    const hiddenChildren = document.getElementById("hiddenChildren");
    const hiddenCheckinDate = document.getElementById("hiddenCheckinDate");
    const hiddenCheckoutDate = document.getElementById("hiddenCheckoutDate");
    const hiddenHotelName = document.getElementById("hiddenHotelName");
    const hiddenHotelPrice = document.getElementById("hiddenHotelPrice");
    const hiddenNights = document.getElementById("hiddenNights");
    const hiddenEntryTotal = document.getElementById("hiddenEntryTotal");
    const hiddenTransTotal = document.getElementById("hiddenTransTotal");
    const hiddenTransCars = document.getElementById("hiddenTransCars");
    const hiddenGuideTotal = document.getElementById("hiddenGuideTotal");
    const hiddenTaxes = document.getElementById("hiddenTaxes");
    const hiddenGrandTotal = document.getElementById("hiddenGrandTotal");

    const bookingForm = document.getElementById("bookingForm");

    /* ---------------------------------------------------------------
       Pricing configuration
       --------------------------------------------------------------- */
    const ticketPricePerPerson = 20;
    const transportPricePerPerson = 30;
    const guidePricePerPerson = 20;
    const taxesAndFees = 12;

    // Transportation / cars configuration:
    // A single car can comfortably fit CAR_CAPACITY guests. Once the group
    // is bigger than that, the system automatically books extra cars and
    // adds EXTRA_CAR_FEE for each additional car (driver/fuel/logistics).
    const CAR_CAPACITY = 4;      // max guests per car
    const EXTRA_CAR_FEE = 25;    // flat fee for each car beyond the first

    let adults = 2;
    let children = 1;
    let includeTrans = false;
    let includeGuide = false;
    let nights = 2;

    let selectedHotelNameValue = "None selected";
    let selectedHotelPricePerNight = 0;
    const hotelCards = document.querySelectorAll(".hotel-card");

    /* ---------------------------------------------------------------
       Date helpers
       --------------------------------------------------------------- */
    const MONTH_NAMES = ["January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"];

    // "YYYY-MM-DD" -> "20 May 2025" (matches the format used across the site)
    function formatDisplayDate(isoDateStr) {
        if (!isoDateStr) return "-";
        const parts = isoDateStr.split("-");
        if (parts.length !== 3) return isoDateStr;
        const [y, m, d] = parts;
        const monthName = MONTH_NAMES[parseInt(m, 10) - 1] || m;
        return `${parseInt(d, 10)} ${monthName} ${y}`;
    }

    function daysBetween(startIso, endIso) {
        const start = new Date(startIso + "T00:00:00");
        const end = new Date(endIso + "T00:00:00");
        const diffMs = end - start;
        return Math.round(diffMs / (1000 * 60 * 60 * 24));
    }

    function todayIso() {
        const d = new Date();
        const y = d.getFullYear();
        const m = String(d.getMonth() + 1).padStart(2, "0");
        const day = String(d.getDate()).padStart(2, "0");
        return `${y}-${m}-${day}`;
    }

    function addDaysIso(isoStr, days) {
        const d = new Date(isoStr + "T00:00:00");
        d.setDate(d.getDate() + days);
        const y = d.getFullYear();
        const m = String(d.getMonth() + 1).padStart(2, "0");
        const day = String(d.getDate()).padStart(2, "0");
        return `${y}-${m}-${day}`;
    }

    // Reads the two date inputs, validates them, and updates `nights`.
    // If check-out is not after check-in, it auto-corrects check-out to
    // one night after check-in and shows a small inline message.
    function syncDatesFromInputs() {
        if (!checkInInput || !checkOutInput) return;

        if (!checkInInput.value) checkInInput.value = todayIso();

        // Check-out can never be before or equal to check-in
        checkOutInput.min = addDaysIso(checkInInput.value, 1);

        if (!checkOutInput.value || checkOutInput.value <= checkInInput.value) {
            checkOutInput.value = addDaysIso(checkInInput.value, 1);
            if (dateErrorText) {
                dateErrorText.textContent = "Check-out date was adjusted to be after check-in.";
                dateErrorText.style.display = "block";
                setTimeout(() => { dateErrorText.style.display = "none"; }, 3000);
            }
        }

        const diff = daysBetween(checkInInput.value, checkOutInput.value);
        nights = diff > 0 ? diff : 1;

        if (hiddenCheckinDate) hiddenCheckinDate.value = formatDisplayDate(checkInInput.value);
        if (hiddenCheckoutDate) hiddenCheckoutDate.value = formatDisplayDate(checkOutInput.value);
        if (summaryCheckin) summaryCheckin.textContent = formatDisplayDate(checkInInput.value);
        if (summaryCheckout) summaryCheckout.textContent = formatDisplayDate(checkOutInput.value);
        if (nightsBadge) nightsBadge.textContent = nights;
    }

    /* ---------------------------------------------------------------
       Main calculator - recalculates everything and refreshes the UI
       --------------------------------------------------------------- */
    function updateCalculator() {
        const totalPeople = adults + children;

        if (adultCountSpan) adultCountSpan.textContent = adults;
        if (childCountSpan) childCountSpan.textContent = children;
        if (nightsCountText) nightsCountText.textContent = nights;

        // Entry tickets
        const entryCost = totalPeople * ticketPricePerPerson;
        if (entryCalcText) entryCalcText.textContent = `$${ticketPricePerPerson} × ${totalPeople}`;
        if (entryTotalPrice) entryTotalPrice.textContent = `$${entryCost}`;

        // Hotel (price per night x number of nights, based on the selected dates)
        const hotelCost = selectedHotelPricePerNight * nights;

        if (selectedHotelPricePerNight > 0) {
            if (hotelBreakdownItem) hotelBreakdownItem.style.display = "flex";
            if (hotelCalcText) hotelCalcText.textContent = `$${selectedHotelPricePerNight} × ${nights}`;
            if (hotelTotalPrice) hotelTotalPrice.textContent = `$${hotelCost}`;
        } else {
            if (hotelBreakdownItem) hotelBreakdownItem.style.display = "none";
        }

        // Transportation: automatically split the group across multiple cars
        // whenever it's bigger than CAR_CAPACITY, and add the extra-car fee.
        let transCost = 0;
        let carsNeeded = Math.max(1, Math.ceil(totalPeople / CAR_CAPACITY));

        if (includeTrans) {
            const extraCars = carsNeeded - 1;
            transCost = (totalPeople * transportPricePerPerson) + (extraCars * EXTRA_CAR_FEE);

            let calcLabel = `$${transportPricePerPerson} × ${totalPeople}`;
            if (extraCars > 0) {
                calcLabel += ` + $${EXTRA_CAR_FEE} × ${extraCars} extra car${extraCars > 1 ? "s" : ""}`;
            }
            if (transCalcText) transCalcText.textContent = calcLabel;
            if (transTotalPrice) transTotalPrice.textContent = `$${transCost}`;
            if (transBreakdownItem) transBreakdownItem.style.display = "flex";

            const statusSpan = transToggleBox ? transToggleBox.querySelector(".toggle-status") : null;
            if (statusSpan) {
                statusSpan.textContent = carsNeeded > 1
                    ? `Included • ${carsNeeded} Cars`
                    : "Included • 1 Car";
            }
        } else {
            if (transBreakdownItem) transBreakdownItem.style.display = "none";
            const statusSpan = transToggleBox ? transToggleBox.querySelector(".toggle-status") : null;
            if (statusSpan) statusSpan.textContent = "Not Included";
        }

        // Tour guide
        let guideCost = 0;
        if (includeGuide) {
            guideCost = totalPeople * guidePricePerPerson;
            if (guideCalcText) guideCalcText.textContent = `$${guidePricePerPerson} × ${totalPeople}`;
            if (guideTotalPrice) guideTotalPrice.textContent = `$${guideCost}`;
            if (guideBreakdownItem) guideBreakdownItem.style.display = "flex";
        } else {
            if (guideBreakdownItem) guideBreakdownItem.style.display = "none";
        }

        // Totals
        const grandTotal = entryCost + hotelCost + transCost + guideCost;
        if (grandTotalPrice) grandTotalPrice.textContent = `$${grandTotal}`;

        const sidebarGrandTotal = hotelCost + entryCost + transCost + guideCost + taxesAndFees;
        if (summaryTotalPrice) summaryTotalPrice.textContent = `$${sidebarGrandTotal}`;

        // Keep the Booking Summary card in sync
        if (summaryGuests) summaryGuests.textContent = `${adults} Adults, ${children} Child${children !== 1 ? "ren" : ""}`;
        if (summaryNights) summaryNights.textContent = nights;
        if (summaryEntryCount) summaryEntryCount.textContent = totalPeople;
        if (summaryEntryPrice) summaryEntryPrice.textContent = `$${entryCost}`;
        if (summaryHotelName) summaryHotelName.textContent = selectedHotelNameValue;
        if (summaryHotelPrice) summaryHotelPrice.textContent = `$${hotelCost}`;
        if (summaryTransPrice) summaryTransPrice.textContent = `$${transCost}`;
        if (summaryGuidePrice) summaryGuidePrice.textContent = `$${guideCost}`;

        // Keep the hidden form fields in sync so checkout.php gets accurate data
        if (hiddenAdults) hiddenAdults.value = adults;
        if (hiddenChildren) hiddenChildren.value = children;
        if (hiddenHotelName) hiddenHotelName.value = selectedHotelNameValue;
        if (hiddenHotelPrice) hiddenHotelPrice.value = selectedHotelPricePerNight;
        if (hiddenNights) hiddenNights.value = nights;
        if (hiddenEntryTotal) hiddenEntryTotal.value = entryCost;
        if (hiddenTransTotal) hiddenTransTotal.value = transCost;
        if (hiddenTransCars) hiddenTransCars.value = includeTrans ? carsNeeded : 1;
        if (hiddenGuideTotal) hiddenGuideTotal.value = guideCost;
        if (hiddenTaxes) hiddenTaxes.value = taxesAndFees;
        if (hiddenGrandTotal) hiddenGrandTotal.value = sidebarGrandTotal;
    }

    /* ---------------------------------------------------------------
       Event listeners
       --------------------------------------------------------------- */
    if (adultPlus) adultPlus.addEventListener("click", () => { adults++; updateCalculator(); });
    if (adultMinus) adultMinus.addEventListener("click", () => { if (adults > 1) { adults--; updateCalculator(); } });
    if (childPlus) childPlus.addEventListener("click", () => { children++; updateCalculator(); });
    if (childMinus) childMinus.addEventListener("click", () => { if (children > 0) { children--; updateCalculator(); } });

    if (checkInInput) {
        checkInInput.addEventListener("change", () => { syncDatesFromInputs(); updateCalculator(); });
    }
    if (checkOutInput) {
        checkOutInput.addEventListener("change", () => { syncDatesFromInputs(); updateCalculator(); });
    }

    hotelCards.forEach(card => {
        const btn = card.querySelector(".select-btn");
        if (!btn) return;

        btn.addEventListener("click", function () {
            const isAlreadySelected = card.classList.contains("selected");

            hotelCards.forEach(c => {
                c.classList.remove("selected");
                const cBtn = c.querySelector(".select-btn");
                if (cBtn) cBtn.innerHTML = "Select";
            });

            if (isAlreadySelected) {
                selectedHotelNameValue = "None selected";
                selectedHotelPricePerNight = 0;
            } else {
                card.classList.add("selected");
                btn.innerHTML = '<i class="ri-check-line"></i> Selected';

                const hotelNameEl = card.querySelector(".hotel-name");
                const hotelPriceEl = card.querySelector(".hotel-price");

                selectedHotelNameValue = hotelNameEl ? hotelNameEl.textContent : "Selected Hotel";
                if (hotelPriceEl) {
                    const priceText = hotelPriceEl.textContent;
                    selectedHotelPricePerNight = parseInt(priceText.replace(/[^0-9]/g, '')) || 0;
                }
            }
            updateCalculator();
        });
    });

    if (bookingForm) {
        bookingForm.addEventListener("submit", function (e) {
            if (selectedHotelPricePerNight <= 0) {
                e.preventDefault();
                alert("Please select a hotel before proceeding to payment.");
                return;
            }
            if (checkInInput && checkOutInput && checkOutInput.value <= checkInInput.value) {
                e.preventDefault();
                alert("Please choose a valid check-out date after your check-in date.");
            }
        });
    }

    if (transToggleBox) {
        transToggleBox.addEventListener("click", () => {
            includeTrans = !includeTrans;
            transToggleBox.classList.toggle("active", includeTrans);

            const selectBtn = transToggleBox.querySelector(".calc-select-btn");
            if (selectBtn) selectBtn.innerHTML = includeTrans ? '<i class="ri-check-line"></i> Selected' : 'Select';

            updateCalculator();
        });
    }

    if (guideToggleBox) {
        guideToggleBox.addEventListener("click", () => {
            includeGuide = !includeGuide;
            guideToggleBox.classList.toggle("active", includeGuide);

            const statusSpan = guideToggleBox.querySelector(".toggle-status");
            const selectBtn = guideToggleBox.querySelector(".calc-select-btn");

            if (statusSpan) statusSpan.textContent = includeGuide ? "Included" : "Not Included";
            if (selectBtn) selectBtn.innerHTML = includeGuide ? '<i class="ri-check-line"></i> Selected' : 'Select';

            updateCalculator();
        });
    }

    /* ---------------------------------------------------------------
       Initial render
       --------------------------------------------------------------- */
    syncDatesFromInputs();
    updateCalculator();
});
