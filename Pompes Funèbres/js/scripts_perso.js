
// Affichage du formulaire optionnel pour les informations concernant le défunt
function aff_defunt(choix) {
    document.getElementById('formulaireDefunt').style.display = (choix == 'oui')? "inline" : "none";
}

// Affichage optionnel des champs Code postal et Ville du formulaire défunt
function aff_defunt_lieux(choix) {
    document.getElementById('lieux').style.display = (choix == 'oui')? "inline" : "none";
}

// Changement de la taille du logo société lors d'un scroll de plus de 100px
window.addEventListener('scroll', function () {
    let logo = document.getElementById('logo');

    if(document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        logo.classList.remove('logo');
        logo.classList.add('scroll');
       
    } else {
        logo.classList.remove('scroll');
        logo.classList.add('logo');
    }
})

// Apparition du texte dans la partie Vous souhaitez nous contacter par écrit de la page Index
let observer1 = new IntersectionObserver(observables => {
    observables.forEach(observable => {
        
    if(observable.intersectionRatio > 0.5) {
        observable.target.classList.remove('opacity0');
        observable.target.classList.add('opacity1');
    } else {
        observable.target.classList.remove('opacity1');
        observable.target.classList.add('opacity0');       
            }
        });
    }, 
    {
    threshold: [0.5]
});

// Apparition du texte dans la partie Devis en ligne de la page Index
let observer2 = new IntersectionObserver(observables => {
    observables.forEach(observable => {
        
    if(observable.intersectionRatio > 0.5) {
        observable.target.classList.remove('opacity0');
        observable.target.classList.add('opacity1');
    } else {
        observable.target.classList.remove('opacity1');
        observable.target.classList.add('opacity0');       
            }
        });
    }, 
    {
    threshold: [0.5]
});

// Apparition de la section Infotrmations de la page Inscription
let observer3 = new IntersectionObserver(observables => {
    observables.forEach(observable => {
    if(observable.intersectionRatio > 0.5) {
        observable.target.classList.remove('dimension0');
        observable.target.classList.add('dimension100');
    } else {
        observable.target.classList.remove('dimension100');
        observable.target.classList.add('dimension0');       
            }
        });
    }, 
    {
    threshold: [0.5]
});

// Apparition de la section de renvoie vers Nous Contacter de la page Inscription
let observer4 = new IntersectionObserver(observables => {
    observables.forEach(observable => {
        
    if(observable.intersectionRatio > 0.5) {
        observable.target.classList.remove('dimension0');
        observable.target.classList.add('dimension100');
    } else {
        observable.target.classList.remove('dimension100');
        observable.target.classList.add('dimension0');       
            }
        });
    }, 
    {
    threshold: [0.5]
});

// Apparition de la section Infotrmations de la page Connexion
let observer5 = new IntersectionObserver(observables => {
    observables.forEach(observable => {
        console.log(observable);
    if(observable.intersectionRatio > 0.5) {
        observable.target.classList.remove('dimension0');
        observable.target.classList.add('dimension100');
    } else {
        observable.target.classList.remove('dimension100');
        observable.target.classList.add('dimension0');       
            }
        });
    }, 
    {
    threshold: [0.5]
});

// Apparition de la section de renvoie vers Nous Contacter de la page Connexion
let observer6 = new IntersectionObserver(observables => {
    observables.forEach(observable => {
    if(observable.intersectionRatio > 0.5) {
        observable.target.classList.remove('dimension0');
        observable.target.classList.add('dimension100');
    } else {
        observable.target.classList.remove('dimension100');
        observable.target.classList.add('dimension0');       
            }
        });
    }, 
    {
    threshold: [0.5]
});


// Ouverture de la modal CGU du Footer
const cguFooter = document.getElementById('cguFooter');

cguFooter.addEventListener('click', () => {
    const modal = document.getElementById('CGU');
    modal.style.display = "block";
})

// Fermeture de la modal CGU du Footer
const cguFooterClose = document.getElementById('fermerCGU');

cguFooterClose.addEventListener('click', () => {
    const modal = document.getElementById('CGU');
    modal.style.display = "none";
})

