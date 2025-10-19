extends Sprite2D

func _ready() -> void:
	if randi_range(1, 99) == 1:
		show()
	else:
		queue_free()

func _on_area_2d_body_entered(body: Node2D) -> void:
	if body is Jugador:
		var tween = create_tween()
		if randi() % 2 == 0:
			AudioPlayer.play_fx("res://Audio/FX/slap.wav")
		else:
			AudioPlayer.play_fx("res://Audio/FX/Ohh.wav")
		tween.tween_property(self, "modulate:a", 0.0, 0.5)
		tween.finished.connect(queue_free)
