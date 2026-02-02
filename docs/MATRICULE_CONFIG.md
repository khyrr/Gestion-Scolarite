# Matricule System Configuration

Add these environment variables to your `.env` file for customization:

```env
# School Configuration
SCHOOL_CODE=ETB
SCHOOL_NAME="École Primaire Example"

# Matricule Format Examples:
# ETB260001 (École Example, 2026, student #1)
# ABC260001 (School ABC, 2026, student #1)
# XYZ270001 (School XYZ, 2027, student #1)
```

## Multi-Tenant Setup Examples:

### School A (.env):
```env
SCHOOL_CODE=EPA  # École Primaire A
SCHOOL_NAME="École Primaire Alpha"
```
**Results**: EPA260001, EPA260002, EPA260003...

### School B (.env):
```env
SCHOOL_CODE=LYB  # Lycée Beta
SCHOOL_NAME="Lycée Beta"
```
**Results**: LYB260001, LYB260002, LYB260003...

This ensures complete isolation between tenants while maintaining professional matricule standards.