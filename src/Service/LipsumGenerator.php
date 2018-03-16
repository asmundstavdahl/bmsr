<?php

namespace App\Service;

class LipsumGenerator
{
    private static $cursor = 0;
    private static $words = ["praesent", "inceptos", "sit", "vehicula", "maecenas", "integer", "magna", "ultrices", "posuere", "ut", "a", "fames", "tempus", "commodo", "venenatis", "ad", "eleifend", "nascetur", "semper", "nullam", "convallis", "cubilia", "dapibus", "nulla", "elementum", "sem", "per", "tincidunt", "himenaeos", "sociosqu", "lobortis", "aptent", "id", "accumsan", "fermentum", "dis", "maximus", "mi", "enim", "vulputate", "varius", "consectetur", "class", "blandit", "morbi", "leo", "porta", "finibus", "aenean", "libero", "rutrum", "penatibus", "interdum", "feugiat", "risus", "laoreet", "magnis", "duis", "proin", "vivamus", "ac", "tempor", "eros", "sodales", "felis", "etiam", "ullamcorper", "scelerisque", "rhoncus", "ligula", "hac", "vitae", "est", "orci", "habitasse", "sollicitudin", "gravida", "torquent", "adipiscing", "purus", "fusce", "erat", "dictum", "nostra", "nisi", "molestie", "parturient", "vel", "litora", "quam", "augue", "tellus", "eu", "vestibulum", "efficitur", "conubia", "ante", "mollis", "ultricies", "viverra", "odio", "tristique", "primis", "quisque", "pellentesque", "consequat", "sapien", "turpis", "dui", "aliquet", "cursus", "malesuada", "ornare", "mauris", "facilisis", "at", "luctus", "dignissim", "pharetra", "aliquam", "auctor", "mattis", "sed", "pretium", "nec", "pulvinar", "donec", "tortor", "elit", "curabitur", "neque", "fringilla", "in", "sagittis", "nisl", "condimentum", "suscipit", "justo", "velit", "suspendisse", "placerat", "nunc", "euismod", "mus", "arcu", "congue", "urna", "non", "egestas", "et", "dictumst", "nibh", "porttitor", "lectus", "lorem", "dolor", "ipsum", "hendrerit", "quis", "massa", "natoque", "montes", "facilisi", "ridiculus", "taciti", "curae;", "faucibus", "nam", "cras", "diam", "phasellus", "lacinia", "lacus", "amet", "imperdiet", "platea", "bibendum", "eget", "ex", "metus", "volutpat"];
    
    public function word(){
        return self::$words[self::$cursor++];
    }
}