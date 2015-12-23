        </div>
    </div> <!-- row -->
</div> <!-- container -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="<?php echo URL ?>dist/js/bootstrap.min.js"></script>
<!-- custom view scripts -->
<?php if(isset($this->js)): ?>
    <?php foreach($this->js as $js): ?>
        <script type="text/javascript" src="<?php echo URL.'view/'.$js ?>" ></script>
    <?php endforeach ?>
<?php endif ?>
</body>
<footer id="footer">

</footer>
</html>