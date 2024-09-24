<?php

function esContrasenhaFuerte($contrasenha)
{
    // Al menos 8 caracteres, al menos una letra mayúscula, al menos una letra minúscula, al menos un número y al menos un caracter especial
    return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).{8,}$/', $contrasenha);
}