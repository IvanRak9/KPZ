from composer import LightElementNode, LightTextNode

def main():
    book_text = """
    Chapter 1: Introduction
    This is the introduction to the book.

    Chapter 2: Body
    This is the main content of the book.

    Conclusion
    This concludes the book.
    """

    lines = book_text.split('\n')

    root = LightElementNode("div", "block", "closing")
    current_element = None

    for line in lines:
        if line.strip() == "":
            continue
        elif line.startswith("Chapter"):
            current_element = LightElementNode("h2", "block", "closing")
            current_element.add_child(LightTextNode(line.strip()))
            root.add_child(current_element)
        elif len(line) < 20:
            current_element = LightElementNode("h3", "block", "closing")
            current_element.add_child(LightTextNode(line.strip()))
            root.add_child(current_element)
        elif line.startswith(" "):
            current_element = LightElementNode("blockquote", "block", "closing")
            current_element.add_child(LightTextNode(line.strip()))
            root.add_child(current_element)
        else:
            current_element = LightElementNode("p", "block", "closing")
            current_element.add_child(LightTextNode(line.strip()))
            root.add_child(current_element)

    def memory_usage(node):
        if isinstance(node, LightTextNode):
            return len(node.text)
        elif isinstance(node, LightElementNode):
            size = len(node.tag_name) + 2  # Враховуємо теги < та >
            for child in node.children:
                size += memory_usage(child)
            return size

    total_memory = memory_usage(root)
    print(f"Total memory usage: {total_memory} characters")

    with open("book.html", "w") as file:
        file.write(root.outer_html())

    print("HTML сторінка збережена у файлі 'book.html'.")


if __name__ == "__main__":
    main()
