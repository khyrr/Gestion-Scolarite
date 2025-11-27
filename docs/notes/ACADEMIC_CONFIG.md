# Configuration Académique

Ce système de gestion scolaire est maintenant entièrement configurable pour s'adapter à différents calendriers académiques.

## Configuration de l'Année Académique

### 1. Configuration dans le fichier .env

Ajoutez ces variables dans votre fichier `.env` :

```env
# Mois de début de l'année académique (1-12)
ACADEMIC_YEAR_START_MONTH=10  # 10 = Octobre

# Configuration Trimestrielle (Écoles Mauritaniennes)
TRIMESTRE_1_START_MONTH=10   # Octobre
TRIMESTRE_1_START_DAY=1
TRIMESTRE_1_END_MONTH=12     # Décembre
TRIMESTRE_1_END_DAY=31

TRIMESTRE_2_START_MONTH=1    # Janvier
TRIMESTRE_2_START_DAY=1
TRIMESTRE_2_END_MONTH=4      # Avril
TRIMESTRE_2_END_DAY=30

TRIMESTRE_3_START_MONTH=5    # Mai
TRIMESTRE_3_START_DAY=1
TRIMESTRE_3_END_MONTH=9      # Septembre
TRIMESTRE_3_END_DAY=30
```

### 2. Exemples de Configuration

#### École Mauritanienne (Octobre - Septembre) - Par Défaut
```env
ACADEMIC_YEAR_START_MONTH=10
TRIMESTRE_1_START_MONTH=10  # Octobre - Décembre
TRIMESTRE_2_START_MONTH=1   # Janvier - Avril
TRIMESTRE_3_START_MONTH=5   # Mai - Septembre
```

#### École Française (Septembre - Juin)
```env
ACADEMIC_YEAR_START_MONTH=9
TRIMESTRE_1_START_MONTH=9   # Septembre - Décembre
TRIMESTRE_2_START_MONTH=1   # Janvier - Mars
TRIMESTRE_3_START_MONTH=4   # Avril - Juin
```

#### École Américaine (Août - Mai)
```env
ACADEMIC_YEAR_START_MONTH=8
TRIMESTRE_1_START_MONTH=8   # Août - Novembre
TRIMESTRE_1_END_MONTH=11
TRIMESTRE_2_START_MONTH=12  # Décembre - Février
TRIMESTRE_2_END_MONTH=2
TRIMESTRE_3_START_MONTH=3   # Mars - Mai
TRIMESTRE_3_END_MONTH=5
```

#### École Australienne (Février - Décembre)
```env
ACADEMIC_YEAR_START_MONTH=2
TRIMESTRE_1_START_MONTH=2   # Février - Avril
TRIMESTRE_1_END_MONTH=4
TRIMESTRE_2_START_MONTH=5   # Mai - Juillet
TRIMESTRE_2_END_MONTH=7
TRIMESTRE_3_START_MONTH=8   # Août - Novembre
TRIMESTRE_3_END_MONTH=11
```

### 3. Système Semestriel (Alternative)

Pour utiliser un système de semestres au lieu de trimestres :

```env
USE_SEMESTERS=true

SEMESTER_1_START_MONTH=10   # Octobre - Février
SEMESTER_1_END_MONTH=2
SEMESTER_2_START_MONTH=3    # Mars - Juillet
SEMESTER_2_END_MONTH=7
```

### 4. Configuration de l'École

```env
SCHOOL_NAME="Nom de votre École"
SCHOOL_ADDRESS="Adresse complète"
SCHOOL_PHONE="Numéro de téléphone"
SCHOOL_EMAIL="contact@ecole.com"
```

## Impact des Modifications

- Les relevés de notes s'adapteront automatiquement aux nouvelles dates
- L'année académique courante sera calculée selon votre configuration
- Les filtres par trimestre/semestre utiliseront vos dates personnalisées
- Aucune modification de code n'est nécessaire

## Notes Importantes

1. Redémarrez votre serveur après modification du fichier `.env`
2. Les dates existantes en base de données ne sont pas affectées
3. La configuration par défaut (Octobre-Juillet, 3 trimestres) correspond au système mauritanien