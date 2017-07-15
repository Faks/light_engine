<?php
if ($_SESSION['logged_in']) 
{
	if ($_SESSION['permission'] >= 4) {
		
	echo "
        	
            <div class='article clearfix'>
            	<div class='post_info'>
                	<ul>
                    <li class='label'>Faks</li>
                    <hr />
                    <li><img src='images/yami_100x56.jpg' /></li>
                    <hr />
                   		<li class='link'><a href='#'>Join Date</a></li>
                    <hr />
                        <li class='link'><a href='#'>Age</a></li>
                        <hr />
                		<li class='link'><a href='#'>Website</a></li>
                        <hr />
                        <li class='link'><a href='#'>Sysop</a></li>
                        <hr />
                		<li class='link'><a href='#'>Stats</a></li>
                       
                  </ul>
                </div>
                
                <div class='main_post'>
                  <div class='about'>
            

           	  <form>
                	<h1 class='post_title'>Contact</h1>
                    
                    <label>
                    	<span>Topic:</span> <input name='title' type='text' id='title' size='40' />
                    </label>
                <label>
                    	<span>Category:</span> 
                  <select name='category' id='category'>
                        <option></option>
                        	<option>Issues</option>
                            <option>Ban</option>
                            <option>Other</option>
                        </select>
                </label>
                <label>                                        </label>
                   
                    
                <label>
                    	<span>Message:</span> <textarea name='longtext' id='about' ></textarea>
                </label>
                    
                    
                  <input name='Submit' type='submit' id='submit_b' value='Send' /> 
                </form>
            </div>
                </div>
            </div>

            
";
	}
}
else
{
	echo $redirect;
}
?>