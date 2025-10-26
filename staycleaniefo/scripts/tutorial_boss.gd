extends VBoxContainer

func _ready() -> void:
	await get_tree().create_timer(10.0).timeout
	queue_free()
