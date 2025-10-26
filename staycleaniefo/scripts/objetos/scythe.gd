extends Node2D

@export var clockwise: bool = true #define si gira el sentido directo o opuesto en sentido del reloj
@export var velocidad: float = 444.0
var direccion: Vector2 = Vector2.RIGHT
var rotacion: float = 120.0


#gira la guadaña y la mueve en una sola direccion hasta destruirse
func _process(delta):
	position += direccion * velocidad * delta
	var direction = 1 if clockwise else -1
	rotation_degrees += rotacion * direction * delta
	await get_tree().create_timer(10.0).timeout
	queue_free() # se destruye a si misma para evitar perdida de memoria
