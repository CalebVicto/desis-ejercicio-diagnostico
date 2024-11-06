
CREATE TABLE bodega (
    bodega_id SERIAL PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL
);

CREATE TABLE sucursal (
    sucursal_id SERIAL PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL,
    bodega_id INTEGER REFERENCES bodega(bodega_id)
);

CREATE TABLE moneda (
    moneda_id SERIAL PRIMARY KEY,
    nombre VARCHAR(30) NOT NULL
);

CREATE TABLE producto (
    codigo VARCHAR(20) PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    precio NUMERIC(10, 2) NOT NULL,
    descripcion TEXT,
    flg_plastico BOOLEAN DEFAULT FALSE,
    flg_metal BOOLEAN DEFAULT FALSE,
    flg_madera BOOLEAN DEFAULT FALSE,
    flg_vidrio BOOLEAN DEFAULT FALSE,
    flg_textil BOOLEAN DEFAULT FALSE,
    bodega_id INTEGER REFERENCES bodega(bodega_id),
    sucursal_id INTEGER REFERENCES sucursal(sucursal_id),
    moneda_id INTEGER REFERENCES moneda(moneda_id)
);
