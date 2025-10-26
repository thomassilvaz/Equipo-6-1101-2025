extends Sprite2D

#funcion easter egg, muestra el personaje secreto segun el numero generado al abrir la escena
func _ready() -> void:
	randomize()
	if randi_range(1, 99) == 1:
		show()
	else:
		queue_free()

#si el easter egg ha sido activado, activa un sonido al entrar al nodo de área
func _on_area_2d_body_entered(body: Node2D) -> void:
	if body is Jugador:
		var tween = create_tween()
		if randi() % 2 == 0:
			AudioPlayer.play_fx("res://Audio/FX/slap.wav")
		else:
			AudioPlayer.play_fx("res://Audio/FX/Ohh.wav")
		tween.tween_property(self, "modulate:a", 0.0, 0.5) #el personaje secreto se desvanece
		tween.finished.connect(queue_free) #el personaje es eliminado posteriormente
