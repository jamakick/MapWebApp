# casessummary.py

import random

texts = ["Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dapibus  a tortor consectetur scelerisque. Nullam tempus id ipsum nec mattis. Suspendisse tristique, lorem a feugiat varius, mi eros laoreet nunc, id pharetra arcu nisl vel lorem. Maecenas ut diam id eros semper aliquam ac quis felis. Sed purus ante, feugiat ut tempor nec, ultricies at nisi. Proin nec sapien suscipit, cursus nulla semper, bibendum dolor. Mauris id arcu sit amet sapien convallis viverra. Curabitur nec mauris a libero luctus molestie ut sed elit. Etiam iaculis purus at vestibulum feugiat. Morbi mi enim, efficitur a feugiat quis, condimentum id dolor.", "Cras lobortis vestibulum justo rutrum ultrices. Donec sodales, lacus quis feugiat elementum, lacus eros imperdiet risus, non aliquam dolor nisi in elit. Sed in justo at est pretium tincidunt nec id eros. Suspendisse et arcu tincidunt, molestie est ac, commodo ex. Nullam in magna dolor. Nulla lorem augue, fringilla quis massa eu, pharetra ultrices risus. Duis dapibus quam id massa imperdiet vestibulum. Phasellus viverra mi id pulvinar interdum. Integer quis consequat augue. Nam suscipit dictum ipsum, tincidunt convallis risus auctor eu. Ut sed sem lacinia, vulputate tortor ut, interdum risus. Donec eleifend egestas elit, ut viverra erat viverra at. Aliquam facilisis mi eu ornare viverra. Aenean vulputate ipsum libero, rutrum ullamcorper     enim elementum at. Vestibulum eu ligula sed nisl suscipit placerat.", "Nulla a turpis sit amet nisl rutrum pharetra at et risus. Nunc egestas vitae sem at convallis. Phasellus auctor eros accumsan hendrerit vulputate. Donec non dui ultricies ligula pharetra interdum. Vestibulum feugiat leo metus, et gravida ante luctus a. Nulla facilisi. Nulla ante ante, feugiat vel nisi a, pulvinar facilisis urna. Nunc velit elit, sodales a metus non, aliquet sollicitudin ante. Aliquam iaculis, turpis nec iaculis tempor, felis arcu aliquet magna, eu placerat dolor odio id dui. In quam felis, consequat tempus rhoncus nec, faucibus a purus. In maximus lectus risus, quis sodales eros egestas et. Praesent at sem nec nibh vehicula condimentum. Morbi commodo metus a urna elementum tincidunt. Pellentesque eu dictum neque. Etiam nec porttitor purus, quis suscipit turpis. Proin ac augue aliquam, congue mi eget, vulputate mauris."]

with open("addsummary.sql", "w") as f:
    for i in range(200):
        summary = random.choice(texts)
        f.write("UPDATE cases SET summary = '" + summary + "' WHERE id = " + str(i + 1) + "; \n")
    f.close()
