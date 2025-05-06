class HTMLElement:
    def __init__(self, tag_name):
        self.tag_name = tag_name
        self.text = ""
        self.state = NormalState(self)

    def set_state(self, state):
        self.state = state

    def render(self):
        return self.state.render()

    def __str__(self):
        return self.render()


class ElementState:
    def __init__(self, element):
        self.element = element

    def render(self):
        raise NotImplementedError()


class NormalState(ElementState):
    def render(self):
        return f"<{self.element.tag_name} class='normal'>Normal {self.element.tag_name}</{self.element.tag_name}>"


class HoveredState(ElementState):
    def render(self):
        return f"<{self.element.tag_name} class='hovered'>Hovered {self.element.tag_name}</{self.element.tag_name}>"


class PressedState(ElementState):
    def render(self):
        return f"<{self.element.tag_name} class='pressed'>Pressed {self.element.tag_name}</{self.element.tag_name}>"


def main():
    button = HTMLElement("button")

    print("Normal:", button.render())

    button.set_state(HoveredState(button))
    print("Hovered:", button.render())

    button.set_state(PressedState(button))
    print("Pressed:", button.render())

    button.set_state(NormalState(button))
    print("Back to Normal:", button.render())

if __name__ == "__main__":
    main()
