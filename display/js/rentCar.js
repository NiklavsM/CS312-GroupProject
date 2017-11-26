function calculatePrice(){
    var oneDay = 24*60*60*1000;
    var dateFromText = document.getElementById("dateFromId").value;
    var dateToText = document.getElementById("dateToId").value;
    var pricePerDay = document.getElementById("pricePerDayId").innerText;
    var priceToPay;

    var dateFromDate;
    var dateToDate;
    var days;

    if(dateFromText && dateToText){
        dateToDate= new Date(dateToText);
        dateFromDate= new Date(dateFromText);
        console.log("here")
        console.log(pricePerDay , "  pricePerDay");
        console.log(Math.round(dateToDate.getTime()-dateFromDate.getTime()));
        days = Math.round((dateToDate.getTime()-dateFromDate.getTime())/ oneDay);
        priceToPay = pricePerDay * days;
        console.log(priceToPay);
        document.getElementById("priceToPayId").innerHTML  = priceToPay;
    }

}
