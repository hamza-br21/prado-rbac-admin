<!DOCTYPE html>
<html>
<head>
    <title>Gestion PRADO</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 20px; background-color: #f4f7f6; }
        
        /* Style de la Navigation */
        nav { 
            background-color: #2c3e50; 
            padding: 1rem; 
            border-radius: 8px; 
            margin-bottom: 20px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        nav a { 
            color: white; 
            text-decoration: none; 
            padding: 10px 15px; 
            font-weight: bold;
            transition: background 0.3s;
        }
        
        nav a:hover { 
            background-color: #34495e; 
            border-radius: 4px;
        }

        .container { 
            background: white; 
            padding: 20px; 
            border-radius: 8px; 
            box-shadow: 0 0 10px rgba(0,0,0,0.05);
        }

        /* Common Styles */
        .actions { margin-bottom: 20px; padding: 10px; background: #f0f0f0; border: 1px solid #ccc; }
        .form-section { margin-top: 20px; padding: 10px; border: 1px solid #ddd; background: #f9f9f9; }
        .datagrid { width: 100%; border-collapse: collapse; }
        .datagrid th, .datagrid td { border: 1px solid #ddd; padding: 8px; }
        .datagrid th { background-color: #f2f2f2; }
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
</html>