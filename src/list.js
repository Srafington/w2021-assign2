
document.addEventListener("DOMContentLoaded", function () {

    const companyData = '/api-companies.php'
    const companies = [];


    /**
     * Event listener for the clear button
     */
    document.querySelector("#clearButton").addEventListener('click', function () {
        document.querySelector("#companyList").innerHTML = "";
        displayCompanies();
    });

    //keyboard event handlers
    const searchBox = document.querySelector('.search');
    searchBox.addEventListener('keyup', displayMatches);

    // hide form and display loading animation
    document.querySelector("form.textbox").style.display = "none";
    document.querySelector("#loading").style.display = "block";

    // fetch from API and save to local storage if companies is empty
    fetch(companyData)
        .then(response => response.json())
        .then(data => {

            document.querySelector("form.textbox").style.display =
                "block";
            document.querySelector("#loading").style.display =
                "none";
            companies.push(...data);
            //updateStorage('comapnies', companies);
            displayCompanies();

        })
        .catch(error => console.error(error));

    /**
    * Displays companies in the list
    */
    function displayCompanies() {
        const list = document.querySelector("#companyList");
        list.innerHTML = "";
        companies.sort(function (a, b) {
            return a.name.toLowerCase() < b.name.toLowerCase() ? -1 : 1;
        }).forEach(company => {
            let option = document.createElement('li');
            option.innerHTML = `<div><img class="smallLogo" src="/logos/${company.symbol}.svg" alt="${company.symbol}"></div><div class="nameLink"><a href="single-company.php?company=${company.symbol}">${company.symbol} ${company.name}</a></div>`;
            list.appendChild(option);
        })
    }

    function displayMatches() {
        filter = searchBox.value.toUpperCase();
        ul = document.querySelector("#companyList");
        li = ul.getElementsByTagName("li");
        for (let i = 0; i < li.length; i++) {
            let item = li[i];
            textValue = item.textContent;
            textValue = textValue.substring(textValue.indexOf(' ')+1);
            if (textValue.toUpperCase().indexOf(filter) === 0) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
    //reference of JS for textbox input matching: https://www.w3schools.com/howto/howto_js_filter_lists.asp
    let x = 0;
    let y = 0;

    document.querySelector("#companyList").addEventListener('mouseover', function (e) {
        if (e.target && e.target.nodeName.toLowerCase() == "img") {
            document.querySelector("#companyList").addEventListener('mousemove', function (e) {
                if (e.target && e.target.nodeName.toLowerCase() == "img") {
                    x = e.clientX;
                    y = e.clientY+50;
                    symbol = e.target.alt;
                    let zoomImg = document.querySelector("#zoomLogo");
                    zoomImg.innerHTML = "";
                    zoomImg.style.display = "block";
                    let img = document.createElement("img");
                    img.src = `/logos/${symbol}.svg`
                    zoomImg.appendChild(img);
                    zoomImg.style.position = "absolute";
                    zoomImg.style.left = `${x}px`;
                    zoomImg.style.top = `${y}px`;
                }
            });
        }
    });

    document.querySelector("#companyList").addEventListener('mouseout', function (e) {
        if (e.target && e.target.nodeName.toLowerCase() == "img") {
            document.querySelector("#zoomLogo").style.display = "none";
        }
    });



});