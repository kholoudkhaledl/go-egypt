document.addEventListener("DOMContentLoaded", function () {
    
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

    const adultMinus = document.getElementById("adultMinus");
    const adultPlus = document.getElementById("adultPlus");
    const adultCountSpan = document.getElementById("adultCount");

    const childMinus = document.getElementById("childMinus");
    const childPlus = document.getElementById("childPlus");
    const childCountSpan = document.getElementById("childCount");

    const transToggleBox = document.getElementById("transToggleBox");
    const guideToggleBox = document.getElementById("guideToggleBox");

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

    const summaryGuests = document.getElementById("summaryGuests");
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
    const hiddenHotelName = document.getElementById("hiddenHotelName");
    const hiddenHotelPrice = document.getElementById("hiddenHotelPrice");
    const hiddenNights = document.getElementById("hiddenNights");
    const hiddenEntryTotal = document.getElementById("hiddenEntryTotal");
    const hiddenTransTotal = document.getElementById("hiddenTransTotal");
    const hiddenGuideTotal = document.getElementById("hiddenGuideTotal");
    const hiddenTaxes = document.getElementById("hiddenTaxes");
    const hiddenGrandTotal = document.getElementById("hiddenGrandTotal");

    const bookingForm = document.getElementById("bookingForm");

    const ticketPricePerPerson = 20;
    const transportPricePerPerson = 30;
    const guidePricePerPerson = 20;
    const numberOfNights = 2;

    let adults = 2;
    let children = 1;
    let includeTrans = false;
    let includeGuide = false;

    let selectedHotelNameValue = "None selected";
    let selectedHotelPricePerNight = 0;
    const hotelCards = document.querySelectorAll(".hotel-card");

    function updateCalculator() {
        const totalPeople = adults + children;

        if (adultCountSpan) adultCountSpan.textContent = adults;
        if (childCountSpan) childCountSpan.textContent = children;
        if (nightsCountText) nightsCountText.textContent = numberOfNights;

        const entryCost = totalPeople * ticketPricePerPerson;
        if (entryCalcText) entryCalcText.textContent = `$${ticketPricePerPerson} × ${totalPeople}`;
        if (entryTotalPrice) entryTotalPrice.textContent = `$${entryCost}`;

        const hotelCost = selectedHotelPricePerNight * numberOfNights;
        
        if (selectedHotelPricePerNight > 0) {
            if (hotelBreakdownItem) hotelBreakdownItem.style.display = "flex";
            if (hotelCalcText) hotelCalcText.textContent = `$${selectedHotelPricePerNight} × ${numberOfNights}`;
            if (hotelTotalPrice) hotelTotalPrice.textContent = `$${hotelCost}`;
        } else {
            if (hotelBreakdownItem) hotelBreakdownItem.style.display = "none";
        }

        let transCost = 0;
        if (includeTrans) {
            transCost = totalPeople * transportPricePerPerson;
            if (transCalcText) transCalcText.textContent = `$${transportPricePerPerson} × ${totalPeople}`;
            if (transTotalPrice) transTotalPrice.textContent = `$${transCost}`;
            if (transBreakdownItem) transBreakdownItem.style.display = "flex";
        } else {
            if (transBreakdownItem) transBreakdownItem.style.display = "none";
        }

        let guideCost = 0;
        if (includeGuide) {
            guideCost = totalPeople * guidePricePerPerson;
            if (guideCalcText) guideCalcText.textContent = `$${guidePricePerPerson} × ${totalPeople}`;
            if (guideTotalPrice) guideTotalPrice.textContent = `$${guideCost}`;
            if (guideBreakdownItem) guideBreakdownItem.style.display = "flex";
        } else {
            if (guideBreakdownItem) guideBreakdownItem.style.display = "none";
        }

        const grandTotal = entryCost + hotelCost + transCost + guideCost;
        if (grandTotalPrice) grandTotalPrice.textContent = `$${grandTotal}`;

        const taxesAndFees = 12;
        const sidebarGrandTotal = hotelCost + entryCost + transCost + guideCost + taxesAndFees;
        if (summaryTotalPrice) summaryTotalPrice.textContent = `$${sidebarGrandTotal}`;

        // Keep the Booking Summary card in sync
        if (summaryGuests) summaryGuests.textContent = `${adults} Adults, ${children} Child${children !== 1 ? "ren" : ""}`;
        if (summaryNights) summaryNights.textContent = numberOfNights;
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
        if (hiddenNights) hiddenNights.value = numberOfNights;
        if (hiddenEntryTotal) hiddenEntryTotal.value = entryCost;
        if (hiddenTransTotal) hiddenTransTotal.value = transCost;
        if (hiddenGuideTotal) hiddenGuideTotal.value = guideCost;
        if (hiddenTaxes) hiddenTaxes.value = taxesAndFees;
        if (hiddenGrandTotal) hiddenGrandTotal.value = sidebarGrandTotal;
    }

    if (adultPlus) adultPlus.addEventListener("click", () => { adults++; updateCalculator(); });
    if (adultMinus) adultMinus.addEventListener("click", () => { if (adults > 1) { adults--; updateCalculator(); } });
    if (childPlus) childPlus.addEventListener("click", () => { children++; updateCalculator(); });
    if (childMinus) childMinus.addEventListener("click", () => { if (children > 0) { children--; updateCalculator(); } });

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
            }
        });
    }

    if (transToggleBox) {
        transToggleBox.addEventListener("click", () => {
            includeTrans = !includeTrans;
            transToggleBox.classList.toggle("active", includeTrans);
            
            const statusSpan = transToggleBox.querySelector(".toggle-status");
            const selectBtn = transToggleBox.querySelector(".calc-select-btn");
            
            if (statusSpan) statusSpan.textContent = includeTrans ? "Included" : "Not Included";
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

    updateCalculator();
});



















// 

// document.addEventListener("DOMContentLoaded", function () {
    
//     const favBtn = document.getElementById("favBtn");
//     if (favBtn) {
//         favBtn.addEventListener("click", function () {
//             const icon = this.querySelector("i");
//             if (icon.classList.contains("ri-heart-line")) {
//                 icon.classList.remove("ri-heart-line");
//                 icon.classList.add("ri-heart-fill");
//                 this.classList.add("active");
//             } else {
//                 icon.classList.remove("ri-heart-fill");
//                 icon.classList.add("ri-heart-line");
//                 this.classList.remove("active");
//             }
//         });
//     }

//     const adultMinus = document.getElementById("adultMinus");
//     const adultPlus = document.getElementById("adultPlus");
//     const adultCountSpan = document.getElementById("adultCount");

//     const childMinus = document.getElementById("childMinus");
//     const childPlus = document.getElementById("childPlus");
//     const childCountSpan = document.getElementById("childCount");

//     const transToggleBox = document.getElementById("transToggleBox");
//     const guideToggleBox = document.getElementById("guideToggleBox");

//     const entryCalcText = document.getElementById("entryCalcText");
//     const entryTotalPrice = document.getElementById("entryTotalPrice");
    
//     const nightsCountText = document.getElementById("nightsCountText");
//     const hotelBreakdownItem = document.querySelector(".calc-breakdown-row .breakdown-item:nth-child(2)");
//     const hotelCalcText = document.getElementById("hotelCalcText");
//     const hotelTotalPrice = document.getElementById("hotelTotalPrice");

//     const transBreakdownItem = document.getElementById("transBreakdownItem");
//     const transCalcText = document.getElementById("transCalcText");
//     const transTotalPrice = document.getElementById("transTotalPrice");

//     const guideBreakdownItem = document.getElementById("guideBreakdownItem");
//     const guideCalcText = document.getElementById("guideCalcText");
//     const guideTotalPrice = document.getElementById("guideTotalPrice");

//     const grandTotalPrice = document.getElementById("grandTotalPrice");

//     const summaryHotelName = document.getElementById("summaryHotelName");
//     const summaryHotelPrice = document.getElementById("summaryHotelPrice");
//     const summaryTotalPrice = document.getElementById("summaryTotalPrice");

//     const ticketPricePerPerson = 20;
//     const transportPricePerPerson = 30;
//     const guidePricePerPerson = 20;
//     const numberOfNights = 2;

//     let adults = 2;
//     let children = 1;
//     let includeTrans = false;
//     let includeGuide = false;

//     let selectedHotelNameValue = "None selected";
//     let selectedHotelPricePerNight = 0;

//     const hotelCards = document.querySelectorAll(".hotel-card");

//     function updateCalculator() {
//         const totalPeople = adults + children;

//         if (adultCountSpan) adultCountSpan.textContent = adults;
//         if (childCountSpan) childCountSpan.textContent = children;
//         if (nightsCountText) nightsCountText.textContent = numberOfNights;

//         const entryCost = totalPeople * ticketPricePerPerson;
//         if (entryCalcText) entryCalcText.textContent = `$${ticketPricePerPerson} × ${totalPeople}`;
//         if (entryTotalPrice) entryTotalPrice.textContent = `$${entryCost}`;

//         const hotelCost = selectedHotelPricePerNight * numberOfNights;
        
//         if (selectedHotelPricePerNight > 0) {
//             if (hotelBreakdownItem) hotelBreakdownItem.style.display = "flex";
//             if (hotelCalcText) hotelCalcText.textContent = `$${selectedHotelPricePerNight} × ${numberOfNights}`;
//             if (hotelTotalPrice) hotelTotalPrice.textContent = `$${hotelCost}`;
//         } else {
//             if (hotelBreakdownItem) hotelBreakdownItem.style.display = "none";
//         }

//         let transCost = 0;
//         if (includeTrans) {
//             transCost = totalPeople * transportPricePerPerson;
//             if (transCalcText) transCalcText.textContent = `$${transportPricePerPerson} × ${totalPeople}`;
//             if (transTotalPrice) transTotalPrice.textContent = `$${transCost}`;
//             if (transBreakdownItem) transBreakdownItem.style.display = "flex";
//         } else {
//             if (transBreakdownItem) transBreakdownItem.style.display = "none";
//         }

//         let guideCost = 0;
//         if (includeGuide) {
//             guideCost = totalPeople * guidePricePerPerson;
//             if (guideCalcText) guideCalcText.textContent = `$${guidePricePerPerson} × ${totalPeople}`;
//             if (guideTotalPrice) guideTotalPrice.textContent = `$${guideCost}`;
//             if (guideBreakdownItem) guideBreakdownItem.style.display = "flex";
//         } else {
//             if (guideBreakdownItem) guideBreakdownItem.style.display = "none";
//         }

//         const grandTotal = entryCost + hotelCost + transCost + guideCost;
//         if (grandTotalPrice) grandTotalPrice.textContent = `$${grandTotal}`;

//         if (summaryHotelName) summaryHotelName.textContent = selectedHotelNameValue;
//         if (summaryHotelPrice) summaryHotelPrice.textContent = `$${hotelCost}`;
        
//         const taxesAndFees = 12;
//         const sidebarGrandTotal = hotelCost + entryCost + transCost + guideCost + taxesAndFees;
//         if (summaryTotalPrice) summaryTotalPrice.textContent = `$${sidebarGrandTotal}`;
//     }

//     if (adultPlus) adultPlus.addEventListener("click", () => { adults++; updateCalculator(); });
//     if (adultMinus) adultMinus.addEventListener("click", () => { if (adults > 1) { adults--; updateCalculator(); } });
//     if (childPlus) childPlus.addEventListener("click", () => { children++; updateCalculator(); });
//     if (childMinus) childMinus.addEventListener("click", () => { if (children > 0) { children--; updateCalculator(); } });

//     hotelCards.forEach(card => {
//         const btn = card.querySelector(".select-btn");
//         if (!btn) return;

//         btn.addEventListener("click", function () {
//             const isAlreadySelected = card.classList.contains("selected");

//             hotelCards.forEach(c => {
//                 c.classList.remove("selected");
//                 const cBtn = c.querySelector(".select-btn");
//                 if (cBtn) cBtn.innerHTML = "Select";
//             });

//             if (isAlreadySelected) {
//                 selectedHotelNameValue = "None selected";
//                 selectedHotelPricePerNight = 0;
//             } else {
//                 card.classList.add("selected");
//                 btn.innerHTML = '<i class="ri-check-line"></i> Selected';

//                 const hotelNameEl = card.querySelector(".hotel-name");
//                 const hotelPriceEl = card.querySelector(".hotel-price");

//                 selectedHotelNameValue = hotelNameEl ? hotelNameEl.textContent : "Selected Hotel";
//                 if (hotelPriceEl) {
//                     const priceText = hotelPriceEl.textContent;
//                     selectedHotelPricePerNight = parseInt(priceText.replace(/[^0-9]/g, '')) || 0;
//                 }
//             }
//             updateCalculator();
//         });
//     });

//     if (transToggleBox) {
//         transToggleBox.addEventListener("click", () => {
//             includeTrans = !includeTrans;
//             transToggleBox.classList.toggle("active", includeTrans);
            
//             const statusSpan = transToggleBox.querySelector(".toggle-status");
//             const selectBtn = transToggleBox.querySelector(".calc-select-btn");
            
//             if (statusSpan) statusSpan.textContent = includeTrans ? "Included" : "Not Included";
//             if (selectBtn) selectBtn.innerHTML = includeTrans ? '<i class="ri-check-line"></i> Selected' : 'Select';
            
//             updateCalculator();
//         });
//     }

//     if (guideToggleBox) {
//         guideToggleBox.addEventListener("click", () => {
//             includeGuide = !includeGuide;
//             guideToggleBox.classList.toggle("active", includeGuide);
            
//             const statusSpan = guideToggleBox.querySelector(".toggle-status");
//             const selectBtn = guideToggleBox.querySelector(".calc-select-btn");
            
//             if (statusSpan) statusSpan.textContent = includeGuide ? "Included" : "Not Included";
//             if (selectBtn) selectBtn.innerHTML = includeGuide ? '<i class="ri-check-line"></i> Selected' : 'Select';
            
//             updateCalculator();
//         });
//     }

//     updateCalculator();
// });