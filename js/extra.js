function createPage(pageId, pageName){

    // Elements
    let activeClass = document.getElementsByClassName("active");    
    activeClass[0].className = "nav-item pointer";
    let pageTitle = document.getElementById("pageTitle");
    let pageRow = document.getElementById(pageId);
    let section = document.getElementById("section");
    
    // Functions       
    pageTitle.innerText = pageName;
    pageRow.classList.add("active");

    if(pageId == "dashboard"){

        // Title Area

        var div1 = document.createElement("div");
        div1.className = "d-sm-flex align-items-center justify-content-between mb-4";
        var div1h1 = document.createElement("h1");
        div1h1.className = "h3 mb-0 text-gray-800";
        div1h1.id = "pageTitle";
        div1h1.innerText = pageName;
        var div1a = document.createElement("a");
        div1a.href = "downloadReport.php";
        div1a.text = " Generate Report ";
        div1a.className = "d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm";        
        var div1ai = document.createElement("i");
        div1ai.className = "fas fa-download fa-sm text-white-50";

        div1a.append(div1ai);
        
        div1.append(div1h1);
        div1.append(div1a);
        section.innerHTML = "";
        section.append(div1);



        // Main Area = div 2 first

        var divRow = document.createElement("div");        
        divRow.className = "row";

        // First Card

        
        var div2div = document.createElement("div");
        div2div.className = "col-xl-3 col-md-6 mb-4";
        var div2divdiv = document.createElement("div");
        div2divdiv.className = "card border-left-primary shadow h-100 py-2";
        var div2divdivdiv = document.createElement("div");
        div2divdivdiv.className = "card-body";
        var div2divdivdivdiv = document.createElement("div");
        div2divdivdivdiv.className = "row no-gutters align-items-center";
    
        div2divdivdiv.append(div2divdivdivdiv);
        div2divdiv.append(div2divdivdiv);        
        div2div.append(div2divdiv);
    
        var div2divdivdivdivdiv = document.createElement("div");
        div2divdivdivdivdiv.className = "col mr-2";
        var div2divdivdivdivdivdiv = document.createElement("div");
        div2divdivdivdivdivdiv.className = "text-xs font-weight-bold text-primary text-uppercase mb-1";
        div2divdivdivdivdivdiv.innerText = "Departure Badget (Monthly)";
        var div2divdivdivdivdivdivdiv = document.createElement("div");
        div2divdivdivdivdivdivdiv.className = "h5 mb-0 font-weight-bold text-gray-800";
        div2divdivdivdivdivdivdiv.innerText = "$10000";
    
        div2divdivdivdivdiv.append(div2divdivdivdivdivdiv);
        div2divdivdivdivdiv.append(div2divdivdivdivdivdivdiv);
        div2divdivdivdiv.append(div2divdivdivdivdiv);
    
        var div2divdivdivdivdivdivdivdiv = document.createElement("div");
        div2divdivdivdivdivdivdivdiv.className = "col-auto";
        var div2divdivdivdivdivdivdivdivi = document.createElement("i");
        div2divdivdivdivdivdivdivdivi.className = "fas fa-calendar fa-2x text-gray-300";
    
        div2divdivdivdivdivdivdivdiv.append(div2divdivdivdivdivdivdivdivi);
    
        
        div2divdivdivdiv.append(div2divdivdivdivdivdivdivdiv);
        divRow.append(div2div);

        // Second Card

        var div3div = document.createElement("div");
        div3div.className = "col-xl-3 col-md-6 mb-4";
        var div3divdiv = document.createElement("div");
        div3divdiv.className = "card border-left-primary shadow h-100 py-2";
        var div3divdivdiv = document.createElement("div");
        div3divdivdiv.className = "card-body";
        var div3divdivdivdiv = document.createElement("div");
        div3divdivdivdiv.className = "row no-gutters align-items-center";
    
        div3divdivdiv.append(div3divdivdivdiv);
        div3divdiv.append(div3divdivdiv);        
        div3div.append(div3divdiv);
    
        var div3divdivdivdivdiv = document.createElement("div");
        div3divdivdivdivdiv.className = "col mr-2";
        var div3divdivdivdivdivdiv = document.createElement("div");
        div3divdivdivdivdivdiv.className = "text-xs font-weight-bold text-success text-uppercase mb-1";
        div3divdivdivdivdivdiv.innerText = "Departure Badget (Monthly)";
        var div3divdivdivdivdivdivdiv = document.createElement("div");
        div3divdivdivdivdivdivdiv.className = "h5 mb-0 font-weight-bold text-gray-800";
        div3divdivdivdivdivdivdiv.innerText = "$10000";
    
        div3divdivdivdivdiv.append(div3divdivdivdivdivdiv);
        div3divdivdivdivdiv.append(div3divdivdivdivdivdivdiv);
        div3divdivdivdiv.append(div3divdivdivdivdiv);
    
        var div3divdivdivdivdivdivdivdiv = document.createElement("div");
        div3divdivdivdivdivdivdivdiv.className = "col-auto";
        var div3divdivdivdivdivdivdivdivi = document.createElement("i");
        div3divdivdivdivdivdivdivdivi.className = "fas fa-dollar-sign fa-2x text-gray-300";
    
        div3divdivdivdivdivdivdivdiv.append(div3divdivdivdivdivdivdivdivi);
    
        
        div3divdivdivdiv.append(div3divdivdivdivdivdivdivdiv);
        divRow.append(div3div);

        // Third Card
        
        var div4div = document.createElement("div");
        div4div.className = "col-xl-3 col-md-6 mb-4";
        var div4divdiv = document.createElement("div");
        div4divdiv.className = "card border-left-primary shadow h-100 py-2";
        var div4divdivdiv = document.createElement("div");
        div4divdivdiv.className = "card-body";
        var div4divdivdivdiv = document.createElement("div");
        div4divdivdivdiv.className = "row no-gutters align-items-center";
    
        div4divdivdiv.append(div4divdivdivdiv);
        div4divdiv.append(div4divdivdiv);        
        div4div.append(div4divdiv);
    
        var div4divdivdivdivdiv = document.createElement("div");
        div4divdivdivdivdiv.className = "col mr-2";
        var div4divdivdivdivdivdiv = document.createElement("div");
        div4divdivdivdivdivdiv.className = "text-xs font-weight-bold text-info text-uppercase mb-1";
        div4divdivdivdivdivdiv.innerText = "Departure Badget (Monthly)";
        var div4divdivdivdivdivdivdiv = document.createElement("div");
        div4divdivdivdivdivdivdiv.className = "h5 mb-0 font-weight-bold text-gray-800";
        div4divdivdivdivdivdivdiv.innerText = "$10000";
    
        div4divdivdivdivdiv.append(div4divdivdivdivdivdiv);
        div4divdivdivdivdiv.append(div4divdivdivdivdivdivdiv);
        div4divdivdivdiv.append(div4divdivdivdivdiv);
    
        var div4divdivdivdivdivdivdivdiv = document.createElement("div");
        div4divdivdivdivdivdivdivdiv.className = "col-auto";
        var div4divdivdivdivdivdivdivdivi = document.createElement("i");
        div4divdivdivdivdivdivdivdivi.className = "fas fa-clipboard-list fa-2x text-gray-300";
    
        div4divdivdivdivdivdivdivdiv.append(div4divdivdivdivdivdivdivdivi);
    
        
        div4divdivdivdiv.append(div4divdivdivdivdivdivdivdiv);
        divRow.append(div4div);

        // Four Card
        
        var div5div = document.createElement("div");
        div5div.className = "col-xl-3 col-md-6 mb-4";
        var div5divdiv = document.createElement("div");
        div5divdiv.className = "card border-left-primary shadow h-100 py-2";
        var div5divdivdiv = document.createElement("div");
        div5divdivdiv.className = "card-body";
        var div5divdivdivdiv = document.createElement("div");
        div5divdivdivdiv.className = "row no-gutters align-items-center";
    
        div5divdivdiv.append(div5divdivdivdiv);
        div5divdiv.append(div5divdivdiv);        
        div5div.append(div5divdiv);
    
        var div5divdivdivdivdiv = document.createElement("div");
        div5divdivdivdivdiv.className = "col mr-2";
        var div5divdivdivdivdivdiv = document.createElement("div");
        div5divdivdivdivdivdiv.className = "text-xs font-weight-bold text-warning text-uppercase mb-1";
        div5divdivdivdivdivdiv.innerText = "Departure Badget (Monthly)";
        var div5divdivdivdivdivdivdiv = document.createElement("div");
        div5divdivdivdivdivdivdiv.className = "h5 mb-0 font-weight-bold text-gray-800";
        div5divdivdivdivdivdivdiv.innerText = "$10000";
    
        div5divdivdivdivdiv.append(div5divdivdivdivdivdiv);
        div5divdivdivdivdiv.append(div5divdivdivdivdivdivdiv);
        div5divdivdivdiv.append(div5divdivdivdivdiv);
    
        var div5divdivdivdivdivdivdivdiv = document.createElement("div");
        div5divdivdivdivdivdivdivdiv.className = "col-auto";
        var div5divdivdivdivdivdivdivdivi = document.createElement("i");
        div5divdivdivdivdivdivdivdivi.className = "fas fa-clipboard fa-2x text-gray-300";
    
        div5divdivdivdivdivdivdivdiv.append(div5divdivdivdivdivdivdivdivi);
    
        
        div5divdivdivdiv.append(div5divdivdivdivdivdivdivdiv);
        divRow.append(div5div);

        // Append All the cards to their Row     
        
        section.append(divRow);


        // Row of overview settings


        var divRow2 = document.createElement("div");        
        divRow2.className = "row";
        
        var div6div = document.createElement("div");
        div6div.className = "col-xl-8 col-lg-7";
        var div6divdiv = document.createElement("div");
        div6divdiv.className = "card shadow mb-4";
        var div6divdivdiv = document.createElement("div");
        div6divdivdiv.className = "card-header py-3 d-flex flex-row align-items-center justify-content-between";
        var div6divdivdivh6 = document.createElement("h6");
        div6divdivdivh6.innerText = "Budget Overview";
        div6divdivdivh6.className = "m-0 font-weight-bold text-primary";

        div6divdivdiv.append(div6divdivdivh6);
        div6divdiv.append(div6divdivdiv);
        div6div.append(div6divdiv);

        var div6divdivdivdiv = document.createElement("div");
        div6divdivdivdiv.className = "card-body";
        var div6divdivdivdivdiv = document.createElement("div");
        div6divdivdivdivdiv.className = "chart-area";
        var div6divdivdivdivdivdiv = document.createElement("div");
        div6divdivdivdivdivdiv.className = "chartjs-size-monitor";
        var div6divdivdivdivdivdivcanvas = document.createElement("canvas");
        div6divdivdivdivdivdivcanvas.id = "myAreaChart";
        div6divdivdivdivdivdivcanvas.className = "chartjs-render-monitor";
        

        div6divdivdivdivdivdiv.append(div6divdivdivdivdivdivcanvas);
        div6divdivdivdivdiv.append(div6divdivdivdivdivdiv);
        div6divdivdivdiv.append(div6divdivdivdivdiv);
        div6divdiv.append(div6divdivdivdiv);

        divRow2.append(div6div); 

        
        // Append All the Charts to their Row     
        
        section.append(divRow2);


    }

}