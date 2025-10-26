extends Area2D

#el enemigo lastima al jugador al entrar al area
func _on_body_entered(body: Node2D) -> void:
	if body is Jugador:
		body.player_damage()
