class HTMLElement:
    def __init__(self, tag_name):
        self.tag_name = tag_name
        self._on_created_hooks = []
        self._on_inserted_hooks = []
        self._on_removed_hooks = []
        self._on_styles_applied_hooks = []
        self._on_class_list_applied_hooks = []
        self._on_text_rendered_hooks = []

    def on_created(self, hook): self._on_created_hooks.append(hook)
    def on_inserted(self, hook): self._on_inserted_hooks.append(hook)
    def on_removed(self, hook): self._on_removed_hooks.append(hook)
    def on_styles_applied(self, hook): self._on_styles_applied_hooks.append(hook)
    def on_class_list_applied(self, hook): self._on_class_list_applied_hooks.append(hook)
    def on_text_rendered(self, hook): self._on_text_rendered_hooks.append(hook)

    def render(self):
        # Template method structure
        self._call_hooks(self._on_created_hooks)
        self._call_hooks(self._on_inserted_hooks)
        self._call_hooks(self._on_styles_applied_hooks)
        self._call_hooks(self._on_class_list_applied_hooks)

        html = f"<{self.tag_name}>"
        html += self.render_content()
        self._call_hooks(self._on_text_rendered_hooks)
        html += f"</{self.tag_name}>"

        self._call_hooks(self._on_removed_hooks)
        return html

    def render_content(self):
        # Hook method
        return f"Sample {self.tag_name} Element"

    def _call_hooks(self, hooks):
        for hook in hooks:
            hook()

def main():
    div = HTMLElement("div")

    div.on_created(lambda: print("[Hook] Element created"))
    div.on_inserted(lambda: print("[Hook] Element inserted"))
    div.on_styles_applied(lambda: print("[Hook] Styles applied"))
    div.on_class_list_applied(lambda: print("[Hook] Class list applied"))
    div.on_text_rendered(lambda: print("[Hook] Text rendered"))
    div.on_removed(lambda: print("[Hook] Element removed"))

    print(div.render())

if __name__ == "__main__":
    main()
