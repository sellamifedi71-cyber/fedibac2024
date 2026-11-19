'use strict';

/**
 * Client-side checks for the Fedi Élégance habit form.
 * Server-side validation in ajout.php remains authoritative.
 */
function verif1(form) {
    if (!form || !(form instanceof HTMLFormElement)) return false;

    const description = String(form.elements.namedItem('description')?.value ?? '').trim();
    const size = String(form.elements.namedItem('taille')?.value ?? '').toUpperCase();
    const priceRaw = String(form.elements.namedItem('prix')?.value ?? '');
    const category = String(form.elements.namedItem('categorie')?.value ?? '');
    const price = Number(priceRaw);

    if (description.length < 5 || description.length > 100) {
        alert('La description doit contenir entre 5 et 100 caractères.');
        form.elements.namedItem('description')?.focus();
        return false;
    }
    if (!['S', 'M', 'L', 'X'].includes(size)) {
        alert('Veuillez choisir une taille valide.');
        form.elements.namedItem('taille')?.focus();
        return false;
    }
    if (!Number.isInteger(price) || price < 1 || price > 100000) {
        alert('Le prix doit être un nombre entier entre 1 et 100 000 TND.');
        form.elements.namedItem('prix')?.focus();
        return false;
    }
    if (!['1', '2', '3', '4', '5'].includes(category)) {
        alert('Veuillez sélectionner une catégorie.');
        form.elements.namedItem('categorie')?.focus();
        return false;
    }
    return true;
}
