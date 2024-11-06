CREATE OR REPLACE FUNCTION insertar_producto(
    p_codigo VARCHAR(20),
    p_nombre VARCHAR(100),
    p_precio NUMERIC(10, 2),
    p_descripcion TEXT,
    p_bodega_id INTEGER,
    p_sucursal_id INTEGER,
    p_moneda_id INTEGER,
    p_flg_plastico BOOLEAN DEFAULT FALSE,
    p_flg_metal BOOLEAN DEFAULT FALSE,
    p_flg_madera BOOLEAN DEFAULT FALSE,
    p_flg_vidrio BOOLEAN DEFAULT FALSE,
    p_flg_textil BOOLEAN DEFAULT FALSE
)
RETURNS VOID AS $$
BEGIN
  
    INSERT INTO producto (
        codigo, nombre, precio, descripcion,
        bodega_id, sucursal_id, moneda_id, 
        flg_plastico, flg_metal, flg_madera, flg_vidrio, flg_textil
    ) 
    VALUES (
        p_codigo, p_nombre, p_precio, p_descripcion, 
        p_bodega_id, p_sucursal_id, p_moneda_id, 
        p_flg_plastico, p_flg_metal, p_flg_madera, p_flg_vidrio, p_flg_textil
    );

END;
$$ LANGUAGE plpgsql;
