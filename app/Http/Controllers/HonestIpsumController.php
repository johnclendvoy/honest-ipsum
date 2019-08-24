<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HonestIpsumRequest;

class HonestIpsumController extends Controller
{
    public $shortest_sentence_length;

    public $defaults = [
        'element_count' => 2,
        'length' => 50,
        'element' => 'p',
        'career' => 'web_developer',
    ];

    function __construct()
    {
        // find the shortest sentence currently in our list
        $min = 1000;
        foreach($this->sentences as $s)
        {
            $s_length = str_word_count($s);
            if($s_length < $min)
            {
                $min = $s_length;
            }
        }
        $this->shortest_sentence_length = $min;
    }

    /*
    * show the main page with the generator, instructions, and the text
    */
    public function generate(HonestIpsumRequest $request)
    {
        $credits = $this->credits;
        $element_count = $request->input('element_count', $this->defaults['element_count']);
        $length = $request->input('length', $this->defaults['length']);
        $element = $request->input('element', $this->defaults['element']);
        $ipsum = $this->getText($element_count, $length, $element);
        return view('honest-ipsum.index', compact('ipsum', 'element', 'element_count', 'length','credits'));
    }

    /* 
    * return just the raw text
    */
    public function api(HonestIpsumRequest $request)
    {
        $length = $request->input('length', $this->defaults['length']);
        $element = $request->input('element', $this->defaults['element']);
        $element_count = $request->input('element_count', $this->defaults['element_count']);
        $career = $request->input('career', $this->defaults['career']);

        // should be able to remove these and validate in the request ????
        if($element != 'p' && $element != 'li') {
            return response()->json([
                'status' => 'error',
                'message' => 'The element must be one of "p", "li", or "br".',
            ]);
        }
        if($length < $this->shortest_sentence_length || $length > 1000) {
            return response()->json([
                'status' => 'error',
                'message' => 'The length must be between ' . $this->shortest_sentence_length.' and 1000.',
            ]);
        }
        if($element_count < 1 || $element_count > 500) {
            return response()->json([
                'status' => 'error',
                'message' => 'The element count must be between 1 and 500.',
            ]);
        }

        $ipsum = $this->getText($element_count, $length, $element);

        $stripped = strip_tags($ipsum);
        $total_words = str_word_count($stripped);
        $chars = strlen($stripped);
        $total_chars = strlen($ipsum);

        return response()->json([
            'words' => $total_words,
            'chars' => $chars,
            'bytes' => $total_chars,
            'result' => $ipsum,
        ]);
    }

    /*
    * @param int $count = a positive integer
    * @param string $format can be 'br', 'p', or 'nl'
    * @param int $paragraph_length number of sentences
    */
    public function getText($count, $paragraph_length, $format)
    {
    	$text = '';
        if('li' == $format){ $text .= '<ul>';}
    	for($i = 0; $i < $count; $i++)
    	{
            if('p' == $format){ $text .= '<p>';}
            if('li' == $format){ $text .= '<li>';}

            $text .= $this->getParagraph($paragraph_length);

            if('p' == $format){ $text .= "</p>\n"; }
            if('li' == $format){ $text .= "</li>\n"; }
    	}
        if('li' == $format){ $text .= '</ul>';}
    	return $text;
    }

    // contunue to add sentences until there is not room for any more
    public function getParagraph($paragraph_length)
    {
        $text = '';
        $remaining = $paragraph_length;
        while($remaining >= $this->shortest_sentence_length)
        {
            $text .= $this->getSentence($remaining) . ' ';
            $remaining = $paragraph_length - str_word_count($text);
        }
        return $text;
    }

    /*
    * return a sentence, the length of the sentence must be less than the amount of words remaining
    */
    public function getSentence($words_remaining){
        $max_index = count($this->sentences)-1;
        $random = mt_rand(0,$max_index);
        $sentence = $this->sentences[$random];

        if(str_word_count($sentence))
        {
            return $sentence;
        }
        else
        {
            return '';
        }
    }

    protected $sentences = [
        'This text is going to be replaced once the website is completed.',
        'The text that you are reading is only to fill the space visually.',
        'Once the website is complete this will read something different and more relevant to the website.',
        'It is useful for web designers to use placeholder text so they can easily see what different fonts look like on a realistic paragraph.',
        'You are currently reading text that is written in English, not Latin.',
        'Some websites use something called Lorem Ipsum to fill in paragraphs that do not have their content finalized.',
        'There needs to be something here, even though it\'s not what you might expect on a finished website.',
        'When a web designer needs to fill in a paragraph temporarily, they will often use some nonsensical Latin words; Not in this paragraph though.',
        'What you are reading now is not what you will be reading in this space once this website goes live.',
        'If you are reviewing this page, it is possible that it will be up to you to provide the content that will replace these sentences.',
        'Some common names for what you are reading are: filler text, placeholder text, and dummy text.',
        'This is just dummy text that is essentially a placeholder so you can see what your final typefaces will look like.',
        'You are currently reading some filler text.',
        'We aren\'t quite sure what to put here yet.',
        'Be careful not to waste too much time reading placeholder text!',
        'This text is only here to validate the page layout. It isn\'t worth reading.',
        'This is just temporary placeholder text; kind of like when a friend saves a spot for you in line, only to be replaced by you when you return.',
        'This text isn’t going to remain here because it doesn\'t pertain to the website.',
        'Eventually, text related to your business, services or products will replace this content.',
        'If you\'re reading this on the live version of the site, most likely someone forgot to replace it. You should probably let the site owner know.',
        'Placeholder text is useful when you need to see what a page design looks like, but the actual content isn\'t available. It\'s like having someone with identical measurements check the fit of a dress before trying it on yourself.',
        'This text is not final and should be replaced.',
        'This is placeholder text that our web designers put here to make sure words appear properly on your website.',
        'At some point someone will replace this block of text with useful words so visitors can learn more about your services/products offered by the website!',
        'If the designer had some useful text to place here, this is how the typeface would appear.',
        'When the final copy for the site has been created, it will go here.',
        'If the designer of this website knew what to put here, they would probably not have to paste text like this here at all.',
        'This paragraph has been copied from a program that automatically generates paragraphs like this.',
        'Determining whether the typeface works or not is only possible if there is text for it to be applied to.',
        'Web Designers use filler text so they can focus on design. It will be replaced with real content before handover.',
        'If you are reading these words, it probably means the website you are viewing is still under construction.',
        'This text is only here to show you what it looks when there is text in this area of the website.',
        'This sentence will be swapped out with actual content before the website is shown to the public.',
        'Placing some text in this area makes it easy to see what a font looks like.',
        'There isn\'t a lot of value in these words. They are just telling you why they are here.',
    ];

    /*
    * users on reddit that helped in some way
    */
    public $credits = [

        // contributed sentences
        'gotnate',
        'Brahminmeat',
        'vmcreative',
        'NotAResponsibleHuman',
        'ddollarsign',
        'TPrimeTommy',
        'melonzipper',
        'Capn_Crusty',
        'mothzilla',
        'piconet-2',
        'bugninga',
        'farnsworth',
        'erm_what_',

        'apaq11', // paragraph length
        'arturojain', // spanish
        'nexus_87', // multiple formats
        // '', // generalize designer
    ];
}
