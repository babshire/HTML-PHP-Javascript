



    function Node(val) {
            this.next = null;
            this.prev = null;
            this.name = val;
        }
        Node.prototype = {
            constructor: Node,
            setPrev: function(node) {
                return this.prev = node;
            },
            setNext: function(node) {
                return this.next = node;
            },
            getName: function() {
                return this.name;
            }
        }


        function List(comparator) {
            this.head = null;
            this.tail = null;
            this.size = 0;
            this.comparator = comparator;
        }


        List.prototype = {
            constructor: List,
            size: function() {
                return this.size;
            },
            isEmpty: function() {
                return this.size === 0;
            },
            insertAtBeginning: function(v) {
                if (this.head != null) {
                    let node = new Node(v);
                    let firstNode = this.head;
                    firstNode.setPrev(node);
                    node.next = firstNode;
                    node.prev = null;
                    this.head = node;
                    this.size++;
                }
                else {
                    let node = new Node(v);
                    this.head = node;
                    this.tail = node;
                    this.size++;
                }
            },
            insertAtEnd: function(v) {
                if (this.tail != null) {
                    let node = new Node(v);
                    let prevNode = this.tail;
                    prevNode.setNext(node);
                    node.next = null;
                    node.prev = prevNode;
                    this.tail = node;
                    this.size++;
                }
                else {
                    let node = new Node(v);
                    this.head = node;
                    this.tail = node;
                    this.size++;
                }
            },
            insertInBetween: function(v) {
                if (this.head != null) {
                    let node = new Node(v);
                    let firstNode = this.head;
                    firstNode.setPrev(node);
                    node.next = firstNode;
                    node.prev = null;
                    this.head = node;
                    this.size++;
                }
                else {
                    let curr = this.head;
                    while (curr != null && this.comparator(v,curr.value) < 0) {
                        curr=curr.next;
                    }
                    /* element was not inserted because it's the end of the list */
                    if (curr == null) {
                        let node = new Node(v);
                        let prevNode = this.tail;
                        prevNode.setNext(node);
                        node.next = null;
                        node.prev = prevNode;
                        this.tail = node;
                        this.size++;
                    } else {
                        let nodeToInsert = new Node(v);
                        let prev = curr.prev;
                        prev.setNext(nodeToInsert);
                        nodeToInsert.setPrev(prev);
                        node.setNext(curr);
                        curr.setPrev(node);
                        this.size++;
                    }
                }
            },
            toString: function() {
                let r = "";
                if (this.head != null) {
                    let curr = this.head;
                    while (curr != null) {
                        r += curr.getName() + "<br>";
                        curr = curr.next;
                    }
                }
                else {
                    r += "Empty List";
                }
                return r;   
            }
        };