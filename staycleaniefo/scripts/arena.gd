extends Node2D

#al cargar la escena, el jugador puede lanzar ataques
func _ready() -> void:
	Estados.puede_disparar = true
