<!DOCTYPE html>
<html>
<head>
    <title>Gestion PRADO</title>
    <style>.grid-pager {
    margin-top: 20px;
    text-align: center;
}

.grid-pager a {
    display: inline-block;
    padding: 8px 14px;
    margin: 3px;
    border-radius: 8px;
    text-decoration: none;
    border: 1px solid #d1d5db;
    color: #374151;
    background: #ffffff;
    transition: 0.2s;
}

.grid-pager a:hover {
    background: #2563eb;
    color: white;
    border-color: #2563eb;
}

.grid-pager span {
    display: inline-block;
    padding: 8px 14px;
    margin: 3px;
    border-radius: 8px;
    background: #2563eb;
    color: white;
    font-weight: bold;
}


  /* Reset léger */
* {
    box-sizing: border-box;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    background-color: #f4f6f9;
}

/* NAVIGATION */
nav {
    background-color: #1f2937;
    padding: 15px 30px;
    display: flex;
    gap: 20px;
    align-items: center;
}

nav a {
    color: #e5e7eb;
    text-decoration: none;
    font-weight: 600;
    padding: 8px 14px;
    border-radius: 6px;
    transition: 0.2s;
}

nav a:hover {
    background-color: #374151;
}

/* Container */
.container {
    max-width: 1200px;
    margin: 30px auto;
    background: white;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.05);
}

/* TITRES */
h1 {
    margin-top: 0;
    font-weight: 600;
    color: #111827;
}

/* Sections */
.actions {
    margin-bottom: 20px;
    padding: 15px;
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
}

/* Inputs */
input[type="text"], select {
    padding: 8px 10px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    outline: none;
    transition: 0.2s;
}

input[type="text"]:focus {
    border-color: #2563eb;
}

/* Buttons */
input[type="submit"], button {
    padding: 8px 14px;
    border: none;
    border-radius: 6px;
    background-color: #2563eb;
    color: white;
    cursor: pointer;
    transition: 0.2s;
}

input[type="submit"]:hover, button:hover {
    background-color: #1d4ed8;
}

/* DATAGRID */
.datagrid {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

.datagrid th {
    background-color: #f3f4f6;
    text-align: left;
    padding: 10px;
    font-weight: 600;
    border-bottom: 2px solid #e5e7eb;
}

.datagrid td {
    padding: 10px;
    border-bottom: 1px solid #f0f0f0;
}

.datagrid tr:hover {
    background-color: #f9fafb;
}

/* FORM SECTION */
.form-section {
    margin-top: 30px;
    padding: 20px;
    border: 1px solid #e5e7eb;
    border-radius: 10px;
    background: #f9fafb;
}

/* FOOTER */
footer {
    margin-top: 40px;
    padding: 20px;
    background: #1f2937;
    color: #e5e7eb;
    text-align: center;
    font-size: 14px;
}


/* Base bouton */
.btn {
    padding: 8px 14px;
    border-radius: 6px;
    border: none;
    font-weight: 600;
    cursor: pointer;
    transition: 0.2s ease-in-out;
    font-size: 14px;
}

/* Modifier */
.btn-edit {
    background-color: #2563eb;
    color: white;
}
.btn-edit:hover {
    background-color: #1d4ed8;
}

/* Supprimer */
.btn-delete {
    background-color: #dc2626;
    color: white;
}
.btn-delete:hover {
    background-color: #b91c1c;
}

/* Enregistrer */
.btn-save {
    background-color: #16a34a;
    color: white;
}
.btn-save:hover {
    background-color: #15803d;
}

/* Annuler */
.btn-cancel {
    background-color: #6b7280;
    color: white;
}
.btn-cancel:hover {
    background-color: #4b5563;
}

/* Rechercher */
.btn-search {
    background-color: #4f46e5;
    color: white;
}
.btn-search:hover {
    background-color: #4338ca;
}



    </style>
</head>
<body>

    <nav>
        <a href="?page=Home">Utilisateurs</a>
        <a href="?page=Profiles">Profils</a>
        <a href="?page=Habilitations">Habilitations</a>
    </nav>

    <div class="container">
        <com:TContentPlaceHolder ID="MainContent" />
    </div>



</body>


    <footer>
    © <?php echo date('Y'); ?> - Gestion PRADO  
    | Hamza.berchil  
    | Version 1.0
</footer>


</html>