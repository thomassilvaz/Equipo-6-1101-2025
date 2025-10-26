extends Control

#muestra la medalla si el jugador tiene la reputacion máxima
func _ready() -> void:
	if Estados.contador == 9:
		show()
	else:
		hide()
