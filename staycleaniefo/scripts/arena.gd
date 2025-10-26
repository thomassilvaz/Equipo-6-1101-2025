extends Node2D

#al entrar a la escena, el jugador puede lanzar ataques
func _ready() -> void:
	Estados.puede_disparar = true
