$("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
});

function getRequeteHttp(){
    // gestion des divers navigateurs
    var requeteHttp;
    if (window.XMLHttpRequest)
    {   // Mozilla
        requeteHttp=new XMLHttpRequest();
        if (requeteHttp.overrideMimeType)
        { // problème firefox
                requeteHttp.overrideMimeType('text/xml');
        }
    }
    else
    {
        if (window.ActiveXObject)
        {	// C'est Internet explorer < IE7
            try
            {
                requeteHttp=new ActiveXObject("Msxml2.XMLHTTP");
            }
            catch(e)
            {
                try
                {
                    requeteHttp=new ActiveXObject("Microsoft.XMLHTTP");
                }
                catch(e)
                {
                    requeteHttp=null;
                }
            }
        }
    }
    return requeteHttp;
}

// déclenchée lors d'un changement dans la sélection d'une classe
function envoyerRequetePraticien(PRA_NUM)
{
    var requeteHttp=getRequeteHttp();

    if (requeteHttp===null)
    {
            alert("Impossible d'utiliser Ajax sur ce navigateur");
    }
    else
    {
         // declenche un post sur la page getinfoclasse.php puis declenchera recevoirInfoClasse
        requeteHttp.open('POST','getinfopraticiens.php',true);
        requeteHttp.onreadystatechange=function() {recevoirInfoPraticien(requeteHttp);};
        requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
        requeteHttp.send('PRA_NUM=' + escape(PRA_NUM));
    }
}

//modifie l'objet libelle_long du document HTML courant à partir de l'information reçue (prenom de l'etudiant) via le flux xml 
function recevoirInfoPraticien(requeteHttp)
{
    //Si la requête s'est bien passé
    if (requeteHttp.readyState === 4)
    {
        if (requeteHttp.status === 200)
        {
            var reponse = requeteHttp.responseText.split(',');
            document.getElementById("num").innerHTML=reponse[0];
            document.getElementById("nom").innerHTML=reponse[1];
            document.getElementById("prenom").innerHTML=reponse[2];
            document.getElementById("adresse").innerHTML=reponse[3];
            document.getElementById("cp").innerHTML=reponse[4];
            document.getElementById("coef").innerHTML=reponse[5];
            document.getElementById("type").innerHTML=reponse[6];

        }
        else
        {
            alert("La requête ne s'est pas correctement exécutée!");
        }
    }
}

function praticienPrecedent(){
    var value = document.getElementById("listeDeroulantePraticiens").value;
    if(value > 1){
        envoyerRequetePraticien(--value);
        document.getElementById("listeDeroulantePraticiens").value = value--;
    }
    else{
        alert("Erreur: vous êtes au début de la liste!");
    }
}

function PraticienSuivant(valueMax){
    var value = document.getElementById("listeDeroulantePraticiens").value;
    if(valueMax > value){
        envoyerRequetePraticien(++value);
        document.getElementById("listeDeroulantePraticiens").value = value++;
    }
    else{
        alert("Erreur: vous avez atteint la fin de la liste!");

    }
}

// déclenchée lors d'un changement dans la sélection d'une classe
function envoyerRequeteVisiteur(idVisiteur)  //Première fonction appelée
{
	var requeteHttp=getRequeteHttp();
	if (requeteHttp==null)
	{
		alert("Impossible d'utiliser Ajax sur ce navigateur");
	}
	else
	{
             // declenche un post sur la page getinfovisiteur.php puis declenchera recevoirInfosVisiteur
		requeteHttp.open('POST','getinfovisiteur.php',true);
		requeteHttp.onreadystatechange=function() {recevoirInfosVisiteur(requeteHttp);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		requeteHttp.send('num_Visiteur=' + escape(idVisiteur));
	}
}

// modifie l'objet libelle_long du document HTML courant à partir de l'information reçue (prenom de l'etudiant) via le flux xml 
function recevoirInfosVisiteur(requeteHttp)
{
	if (requeteHttp.readyState==4) //Si la requete a abouti
	{
		if (requeteHttp.status==200)//Si la requete s'est bien passée
		{
                        var reponse = requeteHttp.responseText.split(/<\/[a-z]+>/);
			document.getElementById("nom").innerHTML=reponse[0];
                        document.getElementById("prenom").innerHTML=reponse[1];//requeteHttp.responseText;
                        document.getElementById("adresse").innerHTML=reponse[2];//requeteHttp.responseText;
                        document.getElementById("ville").innerHTML=reponse[3];//requeteHttp.responseText;
                        document.getElementById("secteur").innerHTML=reponse[4];//requeteHttp.responseText;
		}
		else
		{
			alert("La requête ne s'est pas correctement exécutée");
		}
	}
}


function recevoirListeVisiteurs(requeteHttp)
{
    // traite le flux XML des visiteurs, charge la liste des visiteurs et reinitialise les infos du visiteur sélectionné
	if (requeteHttp.readyState===4)
	{
		if (requeteHttp.status===200)
		{
			var visiteurs=requeteHttp.responseXML.getElementsByTagName("visiteur"); //getvisiteur.php
                        var bodyHtml=document.getElementsByTagName("body").item(0);
			var selectvisiteurs=bodyHtml.getElementsByTagName("select").item(1);
                       
                        document.getElementById('listeVisit').options.length=0;
                       
                        
                       
			var i,j,unVisiteur,option,elements,nomnoeud,valeur;
                        // remplit la liste des etudiants
			for (i=0;i<visiteurs.length;i++){
                            // defini l'objet liste du document HTML
                            option=document.createElement("option");
                            if(i===0){
                                option.setAttribute("selected","selected");
                            }
                            unVisiteur=visiteurs.item(i);
                            // traite tous les tag de chaque etudiant
                            elements=unVisiteur.getElementsByTagName("*");
                            for(j=0;j<elements.length;j++)
                            {
                                // traite le tag 'matricule'  puis le tag 'nom' reçu dans le flux
                                nomnoeud=elements.item(j).nodeName;
                                valeur=elements.item(j).firstChild.nodeValue;
                                if (nomnoeud==='matricule')
                                {
                                    option.setAttribute("value",valeur);
                                }
                                else{
                                    if (nomnoeud==='nom'){
                                        option.appendChild(document.createTextNode(valeur));
                                        selectvisiteurs.appendChild(option);
                                    }
                                }
                            }
			}
                        
                        // traite maintenant les informations des visiteurs
			if(visiteurs.length>0){
                            envoyerRequeteVisiteur(selectvisiteurs.firstChild.getAttribute("value"));
                            
                            document.getElementById("labelListeVisit").style.visibility='visible';
                            document.getElementById("listeVisit").style.visibility='visible';
                            
                            document.getElementById("infosNom").style.visibility='visible';
                            document.getElementById("infosPrenom").style.visibility='visible';
                            document.getElementById("infosAdresse").style.visibility='visible';
                            document.getElementById("infosVille").style.visibility='visible';
                            document.getElementById("infosSecteur").style.visibility='visible';
                            
                            document.getElementById("nom").style.visibility='visible';
                            document.getElementById("prenom").style.visibility='visible';
                            document.getElementById("ville").style.visibility='visible';
                            document.getElementById("adresse").style.visibility='visible';
                            document.getElementById("secteur").style.visibility='visible';
                            
                            if(visiteurs.length>1){
                                document.getElementById("btnPrecedent").style.visibility='visible';
                                document.getElementById("btnSuivant").style.visibility='visible';
                            }else{
                                document.getElementById("btnPrecedent").style.visibility='hidden';
                                document.getElementById("btnSuivant").style.visibility='hidden'; 
                            }
                            
                            
			}else{  //Cache la liste déroulante des visiteurs et leurs infos si il n'y a pas de visiteurs dans ce département
                            alert("Il n'y a pas de visiteur dans ce département");
                            
                            document.getElementById("labelListeVisit").style.visibility='hidden';
                            document.getElementById("listeVisit").style.visibility='hidden';
                            
                            document.getElementById("infosNom").style.visibility='hidden';
                            document.getElementById("infosPrenom").style.visibility='hidden';
                            document.getElementById("infosAdresse").style.visibility='hidden';
                            document.getElementById("infosVille").style.visibility='hidden';
                            document.getElementById("infosSecteur").style.visibility='hidden';
                            
                            document.getElementById("nom").style.visibility='hidden';
                            document.getElementById("prenom").style.visibility='hidden';
                            document.getElementById("ville").style.visibility='hidden';
                            document.getElementById("adresse").style.visibility='hidden';
                            document.getElementById("secteur").style.visibility='hidden';
                            
                            document.getElementById("btnPrecedent").style.visibility='hidden';
                            document.getElementById("btnSuivant").style.visibility='hidden';  
			}
		}else{
                    alert("RECEVOIR LISTE VISITEUR: La requête ne s'est pas correctement exécutée");
		}
	}
}

// déclenchée lors d'un changement dans la sélection d'une classe
function envoyerRequeteListeDepartement(code){
	var requeteHttp=getRequeteHttp();
	if (requeteHttp==null)
	{
		alert("Impossible d'utiliser Ajax sur ce navigateur");
	}
	else
	{
            if(code==='00'){    //Cas où l'on sélectionne le champs par défault => cache la liste Visiteur et les infos
                document.getElementById("labelListeVisit").style.visibility='hidden';
                document.getElementById("listeVisit").style.visibility='hidden';

                document.getElementById("infosNom").style.visibility='hidden';
                document.getElementById("infosPrenom").style.visibility='hidden';
                document.getElementById("infosAdresse").style.visibility='hidden';
                document.getElementById("infosVille").style.visibility='hidden';
                document.getElementById("infosSecteur").style.visibility='hidden';

                document.getElementById("nom").style.visibility='hidden';
                document.getElementById("prenom").style.visibility='hidden';
                document.getElementById("ville").style.visibility='hidden';
                document.getElementById("adresse").style.visibility='hidden';
                document.getElementById("secteur").style.visibility='hidden';
                
                document.getElementById("btnPrecedent").style.visibility='hidden';
                document.getElementById("btnSuivant").style.visibility='hidden';
                
            }else{
            // declenche un post sur la page getetudiants.php puis declenchera recevoirListeEtudiants
		requeteHttp.open('POST','getvisiteur.php',true);
		requeteHttp.onreadystatechange=function() {recevoirListeVisiteurs(requeteHttp);};
		requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		requeteHttp.send('code=' + escape(code));
            }
	}
	return;
}

// Bouton qui permet de passer au visiteur précédent dans la liste déroulante courante
function visiteurPrecedent(){
    var numVisiteurActuel=document.getElementById("listeVisit").value;
    
    var trouve=false;
    var numPrecedentVisiteur;
    var mesOptions=document.getElementById("listeVisit").options;
    var i=mesOptions.length-1;
    if(mesOptions[0].value===numVisiteurActuel){
        alert("Il n'y a pas d'autre visiteur avant");
    }else{
        while(!trouve && i>0){
            if(mesOptions[i].value===numVisiteurActuel){
                trouve=true;
            }
            i--;
            numPrecedentVisiteur=mesOptions[i].value;
            
        }
        if(trouve){
            document.getElementById("listeVisit").value=numPrecedentVisiteur;
            envoyerRequeteVisiteur(numPrecedentVisiteur);
        }
    }
}


// Bouton qui permet de passer au visiteur suivant dans la liste déroulante courante
function visiteurSuivant(){
    var numVisiteurActuel=document.getElementById("listeVisit").value;
    var i=0;
    var trouve=false;
    var mesOptions=document.getElementById("listeVisit").options;
    if(mesOptions[(mesOptions.length)-1].value===numVisiteurActuel){
        alert("Il n'y a pas d'autre visiteur après");
    }else{
        while(!trouve && i<mesOptions.length){
            if(mesOptions[i].value!==numVisiteurActuel){
                i++;
            }else{
                i++;
                var numProchainVisiteur=mesOptions[i].value;
                document.getElementById("listeVisit").value=numProchainVisiteur;
                envoyerRequeteVisiteur(numProchainVisiteur);
                trouve=true;
            }
        }
    }
}

// déclenchée lors d'un changement dans la sélection d'une classe
    function envoyerRequeteMedicament(idMed) {
        var requeteHttp=getRequeteHttp();
        if (requeteHttp==null)
        {
            alert("Impossible d'utiliser Ajax sur ce navigateur");
        }
        else
        {
            // declenche un post sur la page getinfoclasse.php puis declenchera recevoirInfoMed
            requeteHttp.open('POST','getinfoMed.php',true);
            requeteHttp.onreadystatechange=function() {recevoirInfoMed(requeteHttp);};
            requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            requeteHttp.send('MED_DEPOTLEGAL='+escape(idMed));
        }
    }

    // modifie l'objet libelle_long du document HTML courant à partir de l'information reçue (prenom de l'etudiant) via le flux xml
    function recevoirInfoMed(requeteHttp)
    {
        if (requeteHttp.readyState==4)
        {
            if (requeteHttp.status==200)
            {
                var reponse = requeteHttp.responseText.split(' - ');
                document.getElementById("MED_DEPOTLEGAL").innerHTML=reponse[0];
                document.getElementById("FAM_CODE").innerHTML=reponse[1];
                document.getElementById("MED_NOMCOMMERCIAL").innerHTML=reponse[2];
                document.getElementById("MED_COMPOSITION").innerHTML=reponse[3];
                document.getElementById("MED_EFFETS").innerHTML=reponse[4];
                document.getElementById("MED_CONTREINDIC").innerHTML=reponse[5];
                document.getElementById("MED_PRIXECHANTILLON").innerHTML=reponse[6];
            }
            else
            {
                alert("La requête ne s'est pas correctement exécutée");
            }
        }
    }

    /*

--------------------------------------------------------------------------------------------------------------------------------------------------

    */

    function envoyerRequeteMedicamentPrecedent() {
        //var_dump(idMed);
        var requeteHttp=getRequeteHttp();
        if (requeteHttp==null)
        {
            alert("Impossible d'utiliser Ajax sur ce navigateur");
        }
        else
        {
            //var_dump(idMed);
            //declenche un post sur la page getinfoclasse.php puis declenchera recevoirInfoMedPrecedent
            requeteHttp.open('POST','getInfoMedPrecedent.php',true);
            requeteHttp.onreadystatechange = function() {recevoirInfoMedPrecedent(requeteHttp);};
            requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            requeteHttp.send('MED_DEPOTLEGAL='+escape(document.getElementById('listeMed').value));
        }
    }

    // modifie l'objet libelle_long du document HTML courant à partir de l'information reçue (prenom de l'etudiant) via le flux xml
    function recevoirInfoMedPrecedent(requeteHttp)
    {
        if (requeteHttp.readyState==4)
        {
            if (requeteHttp.status==200)
            {
                // transforme la requette xml en tableau, et creer un nouvel indice chaque fois que le caractere en parametre existe.
                var reponse = requeteHttp.responseText.split(' - ');
                document.getElementById("MED_DEPOTLEGAL").innerHTML=reponse[0];
                document.getElementById("FAM_CODE").innerHTML=reponse[1];
                document.getElementById("MED_NOMCOMMERCIAL").innerHTML=reponse[2];
                document.getElementById("MED_COMPOSITION").innerHTML=reponse[3];
                document.getElementById("MED_EFFETS").innerHTML=reponse[4];
                document.getElementById("MED_CONTREINDIC").innerHTML=reponse[5];
                document.getElementById("MED_PRIXECHANTILLON").innerHTML=reponse[6];;
            }
            else
            {
                alert("La requête ne s'est pas correctement exécutée");
            }
        }
    }
    /*

--------------------------------------------------------------------------------------------------------------------------------------------------
    */

// function qui permet d'envoyer l'ID MED_DEPOTLEGAL a notre function recevoirInfoMedSuivant
    function envoyerRequeteMedicamentSuivant() {
        var requeteHttp=getRequeteHttp();
        if (requeteHttp==null)
        {
            alert("Impossible d'utiliser Ajax sur ce navigateur");
        }
        else
        {
            //declenche un post sur la page getinfoclasse.php puis declenchera recevoirInfoMedSuivant
            requeteHttp.open('POST','getInfoMedSuivant.php',true);
            requeteHttp.onreadystatechange = function() {recevoirInfoMedSuivant(requeteHttp);};
            requeteHttp.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            requeteHttp.send('MED_DEPOTLEGAL='+escape(document.getElementById('listeMed').value));
        }
    }


    function recevoirInfoMedSuivant(requeteHttp)
    {
        if (requeteHttp.readyState==4)
        {
            if (requeteHttp.status==200)
            {
                // transforme la requette xml en tableau, et creer un nouvel indice chaque fois que le caractere en parametre existe.
                var reponse = requeteHttp.responseText.split(' - ');
                document.getElementById("MED_DEPOTLEGAL").innerHTML=reponse[0];
                document.getElementById("FAM_CODE").innerHTML=reponse[1];
                document.getElementById("MED_NOMCOMMERCIAL").innerHTML=reponse[2];
                document.getElementById("MED_COMPOSITION").innerHTML=reponse[3];
                document.getElementById("MED_EFFETS").innerHTML=reponse[4];
                document.getElementById("MED_CONTREINDIC").innerHTML=reponse[5];
                document.getElementById("MED_PRIXECHANTILLON").innerHTML=reponse[6];
            }
            else
            {
                alert("La requête ne s'est pas correctement exécutée");
            }
        }
    }

/*

--------------------------------------------------------------------------------------------------------------------------------------------------

*/

    function selectSuivante(){
        // function qui permet d'actualiser la liste deroulante avec avoir demander le suivant
        var liste = document.getElementById("listeMed");
        var lesOptions = liste.options;
        var i = 0;
        var trouve = false;
        while (i < lesOptions.length && trouve != true) {
            if (lesOptions[i].value == liste.value) {
                i++;
                if(i == lesOptions.length) {
                    alert("Erreur, il n'y a plus de medicaments");
                }else {
                    trouve = true;
                    envoyerRequeteMedicamentSuivant();
                    // actualise la liste deroulante avec l'indice enregistrer
                    liste.selectedIndex = i;
                }
            }else {
                i++;
            }
        }
    }

    function selectPrecedent(){
        // function qui permet d'actualiser la liste deroulante avec avoir demander le precedent
        var liste = document.getElementById("listeMed");
        var lesOptions = liste.options;
        var i = 0;
        var trouve = false;
        while (i < lesOptions.length && trouve != true) {
            if (lesOptions[i].value == liste.value) {
                i--;
                if(i < 0) {
                    alert("Erreur, il n'y a pas de medicaments avant");
                }else {
                    trouve = true;
                    envoyerRequeteMedicamentPrecedent();
                    // actualise la liste deroulante avec l'indice enregistrer
                    liste.selectedIndex = i;
                }
            }else {
                i++;
            }
        }
    }