extends Sprite2D

#activa los efectos psicodelicos si se han consumido 2 sustancias
func _physics_process(_delta: float) -> void:
	if Estados.escuela_oscura == 2:
		set_physics_process(false)
		show()
		create_tween().tween_property(self, "modulate:a", 0.3, 2.0)
	else:
		hide()
		self.modulate.a = 0.0
